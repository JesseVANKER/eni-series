<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/series')]
class SeriesController extends AbstractController
{
    #[Route('/', name: 'series_list')]
    public function list(SerieRepository $serieRepository): Response
    {
        // recuperer les séries de la base de données trié par date de sortie

        //$series = $serieRepository->findBy([], ['firstAirDate'=>'DESC', 'name'=>'ASC']);
        //$series = $serieRepository->findAllByYear(2020);
        //$series = $serieRepository->findAllBetweenDates(new \DateTime('2019-01-01'), new \DateTime('2020-01-01'));
        $series = $serieRepository->findAllWithSeasons();
        return $this->render('series/index.html.twig', [
            'series'=>$series
        ]);
    }
/*
    #[Route('/{id}', name: 'series_detail', requirements: ['id' => '\d+'])]
    public function detail(int $id, SerieRepository $serieRepository): Response
    {

        $serie = $serieRepository->find($id);

        return $this->render('series/detail.html.twig',[
            'id'=>$id,
            'serie'=>$serie
        ]);
    }
*/
    // MEME CHOSE EN RACCOURCI

    #[Route('/{id}', name: 'series_detail', requirements: ['id' => '\d+'])]
    public function detail(SerieRepository $serieRepository, int $id): Response
    {
        // Récupérer la série à afficher en base de données
        $serie = $serieRepository->find($id);

        if ($serie === null) {
            throw $this->createNotFoundException('Page not found');
        }

        return $this->render('series/detail.html.twig', [
            'serie' => $serie
        ]);
    }

    #[Route('/new', name: 'series_new')]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $serie = new Serie();
        $serie->setDateCreated(new \DateTime());
        $serie->setDateModified(new \DateTime());
        $serieForm = $this->createForm(SerieType::class, $serie);

        //RECUPERATION DES DONNEES
        $serieForm->handleRequest($request);

        //CHECK IF USER IS SENDING FORM
        if($serieForm->isSubmitted() && $serieForm->isValid()){

            /* REFUSER SUBMIT SI NON ADMIN
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
             */
            $em->persist($serie);
            $em->flush();

            $this->addFlash('success', 'La série a bien été créée !');

            // Rediriger l'internaute vers la liste des séries
            return $this->redirectToRoute('series_list');
        }


        return $this->render('series/new.html.twig', [
            'serieForm' => $serieForm->createView()
        ]);
    }

}

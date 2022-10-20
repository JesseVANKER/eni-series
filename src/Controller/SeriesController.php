<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/series')]
class SeriesController extends AbstractController
{
    #[Route('/', name: 'series_list')]
    public function list(SerieRepository $serieRepository): Response
    {
        // recuperer les séries de la base de données
        $series = $serieRepository->findAll();

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
    public function detail(Serie $serie): Response
    {

        return $this->render('series/detail.html.twig',[
            'serie'=>$serie
        ]);
    }

    #[Route('/new', name: 'series_new')]
    public function new(): Response
    {
        return $this->render('series/new.html.twig',[

        ]);
    }
}

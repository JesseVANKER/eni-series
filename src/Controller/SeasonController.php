<?php

namespace App\Controller;

use App\Entity\Season;
use App\Form\SeasonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[ROUTE('/season')]
class SeasonController extends AbstractController
{
    #[Route('/create', name: 'season_create')]
    public function index(): Response
    {
        $season = new Season();
        $seasonForm = $this->createForm(SeasonType::class, $season);

        return $this->render('season/create.html.twig', [
            'seasonForm' => $seasonForm->createView(),
        ]);
    }
}

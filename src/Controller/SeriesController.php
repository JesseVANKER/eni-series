<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/series')]
class SeriesController extends AbstractController
{
    #[Route('/', name: 'series_list')]
    public function list(): Response
    {
        $series = [
            [
                'id' => 1,
                'title' => 'Game of throne'
            ],
            [
                'id' => 2,
                'title' => 'Les Anneaux de pouvoirs'
            ],
        ];
        return $this->render('series/index.html.twig', [
            'series'=>$series
        ]);
    }

    #[Route('/{id}', name: 'series_detail', requirements: ['id' => '\d+'])]
    public function detail(int $id): Response
    {
        // TODO: Récupérer la série à afficher en base de données
        return $this->render('series/detail.html.twig',[
            'id'=>$id
        ]);
    }

    #[Route('/new', name: 'series_new')]
    public function new(): Response
    {
        return $this->render('series/new.html.twig',[

        ]);
    }
}

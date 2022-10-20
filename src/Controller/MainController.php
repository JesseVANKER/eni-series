<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        $city = 'Ougadougou';
        $vegetables = ['Courgette', 'Carotte', 'Radis'];
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'city' => $city,
            'vegetables' => $vegetables,
            'now' => new \DateTime()
        ]);
    }
    #[Route('/contact', name:'contact')]
    public function contact(): Response
    {
        return $this->render('main/contact.html.twig');
    }

}

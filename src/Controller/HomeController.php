<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home.index')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'title' => 'Accueil'
        ]);
    }

    #[Route('/forum', name: 'home.forum')]
    public function forum(): Response
    {
        return $this->render('home/forum.html.twig', [
            'title' => 'Forum'
        ]);
    }

    #[Route('/tutorials', name: 'home.tutorials')]
    public function tutorials(): Response
    {
        return $this->render('home/tutorials.html.twig', [
            'title' => 'Tutoriels'
        ]);
    }

    #[Route('/live', name: 'home.live')]
    public function live(): Response
    {
        return $this->render('home/live.html.twig', [
            'title' => 'Live'
        ]);
    }
}

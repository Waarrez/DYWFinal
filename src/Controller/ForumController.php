<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForumController extends AbstractController
{
    #[Route('/forum/subject', name: 'forum.subject')]
    public function subject() : Response {
        return $this->render('forum/forum_subject.html.twig', [
            'title' => 'Sujet 1'
        ]);
    }
}
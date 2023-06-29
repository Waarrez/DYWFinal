<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class ToolController extends AbstractController
{
    #[Route('/', name: 'home.index')]
    public function index(): Response
    {
        return $this->render('tool/index.html.twig');
    }

    #[Route('/api/session')]
    public function getSessionData(): JsonResponse
    {
        if($this->getUser() !== null) {
            return new JsonResponse(true);
        }

        return new JsonResponse(false);
    }
}

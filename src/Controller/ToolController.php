<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToolController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    #[Route('/', name: 'home.index')]
    public function index(): Response
    {
        return $this->render('tool/index.html.twig');
    }

    #[Route('/confirm-account/{token}', name: 'home.confirmAccount')]
    public function confirmAccount(string $token): ?Response
    {
        $confirm = $this->userRepository->findBy(['isVerify' => $token]);

        foreach ($confirm as $verify) {
            if ($verify->getIsVerify() === $token) {
                $user = $verify->setIsVerify('');
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $this->addFlash('success', 'Votre compte à bien été confirmé');
            }
        }

        return $this->render('tool/confirm-account.html.twig');
    }
}

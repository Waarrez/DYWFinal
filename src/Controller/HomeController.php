<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Entity\User;
use App\Form\RegisterForm\RegisterForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {}

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

    #[Route('/register', name: 'home.register')]
    public function register(Request $request) : Response {

        $user = new User();
        $profile = new Profile();

        $form = $this->createForm(RegisterForm::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('password')->getData();

            $hashedPassword = $this->passwordHasher->hashPassword($user, $password);

            $user->setPassword($hashedPassword);

            $profile->setUsers($user);
            $this->entityManager->persist($user);
            $this->entityManager->persist($profile);
            $this->entityManager->flush();

            return $this->redirectToRoute('home.index');
        }

        return $this->render('security/register.html.twig', [
            'title' => 'Inscription',
            'form' => $form->createView()
        ]);
    }
}

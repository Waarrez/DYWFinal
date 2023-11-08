<?php

namespace App\Controller;

use App\Repository\TutorialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ToolController extends AbstractController
{
    public function __construct(
        private readonly TutorialRepository $tutorialRepository
    )
    {
    }

    #[Route('/', name: 'home.index')]
    public function index(): Response
    {
        return $this->render('tool/index.html.twig');
    }


    #[Route("/api/tutorial/{slug}", methods: "GET")]
    public function getSlugTutorial(string $slug, SerializerInterface $serializer): JsonResponse
    {
        $tutorial = $this->tutorialRepository->findBySlug($slug);

        $jsonData = $serializer->serialize($tutorial, 'json', [
            'groups' => "tutorials_read"
        ]);

        return new JsonResponse($jsonData, 200, [], true);
    }
}

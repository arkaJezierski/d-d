<?php

namespace App\Controller\Api;

use App\Repository\StoryRepository;
use App\Repository\StoryStepRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/stories', name: 'api_stories_')]
final class StoryController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(StoryRepository $storyRepository): JsonResponse
    {
        $stories = $storyRepository->findAll();

        $data = array_map(function ($story) {
            return [
                'id' => $story->getId(),
                'title' => $story->getTitle(),
                'description' => $story->getDescription(),
                'author' => $story->getAuthor()?->getName(),
            ];
        }, $stories);

        return $this->json($data);
    }

    #[Route('/{id}/start', name: 'start', methods: ['GET'])]
    public function start(int $id, StoryStepRepository $stepRepo): JsonResponse
    {
        $step = $stepRepo->findOneBy(['story' => $id, 'isStart' => true]);

        if (!$step) {
            return $this->json(['error' => 'Start step not found'], 404);
        }

        return $this->json([
            'step_id' => $step->getId(),
            'description' => $step->getDescription(),
            'choices' => array_map(fn($choice) => [
                'id' => $choice->getId(),
                'text' => $choice->getText(),
            ], $step->getStoryChoices()->toArray())
        ]);
    }
}

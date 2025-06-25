<?php

namespace App\Controller\Api;

use App\Repository\StoryChoiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/choose', name: 'api_choose_', methods: ['POST'])]
class ChoiceController extends AbstractController
{
    public function __invoke(Request $request, StoryChoiceRepository $choiceRepo): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $choiceId = $data['choice_id'] ?? null;

        if (!$choiceId) {
            return $this->json(['error' => 'Missing choice_id'], 400);
        }

        $choice = $choiceRepo->find($choiceId);

        if (!$choice) {
            return $this->json(['error' => 'Choice not found'], 404);
        }

        $nextStep = $choice->getNextStep();

        if (!$nextStep) {
            return $this->json(['end' => true, 'message' => 'To koniec historii']);
        }

        return $this->json([
            'step_id' => $nextStep->getId(),
            'description' => $nextStep->getDescription(),
            'choices' => array_map(fn($c) => [
                'id' => $c->getId(),
                'text' => $c->getText(),
            ], $nextStep->getStoryChoices()->toArray())
        ]);
    }
}

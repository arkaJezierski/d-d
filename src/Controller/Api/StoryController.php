<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StoryController extends AbstractController
{
    #[Route('/api/story', name: 'app_api_story')]
    public function index(): Response
    {
        return $this->render('api/story/index.html.twig', [
            'controller_name' => 'Api/StoryController',
        ]);
    }
}

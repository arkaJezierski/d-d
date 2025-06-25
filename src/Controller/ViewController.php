<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

    #[Route('/{vueRouting}', name: 'vue_app', requirements: ['vueRouting' => '^(?!api|_wdt|_profiler).+'], defaults: ['vueRouting' => null])]
    public function vueIndex(): Response
    {
        return $this->render('base.html.twig');
    }
}

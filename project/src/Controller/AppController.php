<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Interventions;
use App\Entity\Agents;
use App\Entity\Services;
use App\Entity\Directions;

/**
 * @Route("/dashboard")
 */
class AppController extends AbstractController
{
    /**
     * @Route("/", name="app_accueil")
     */
    public function index(): Response
    {
        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }
}

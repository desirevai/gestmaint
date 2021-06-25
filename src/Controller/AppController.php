<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard")
 */
class AppController extends AbstractController
{
    /**
     * @Route("", name="app_accueil")
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('app/index.html.twig', [
            'active' => 'accueil',
        ]);
    }
}

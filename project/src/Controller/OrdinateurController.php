<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ordinateurs;

/**
 * @Route("/dashboard/ordinateurs")
 */
class OrdinateurController extends AbstractController
{
    /**
     * @Route("/", name="app_ordinateur")
     */
    public function ordinateur(): Response
    {
        $datas = $this->getDoctrine()->getRepository(Ordinateurs::class)->findBy([], ['id' => 'desc']);
        // dd($datas);
        return $this->render('app/ordinateur/index.html.twig', [
            'active' => 'ordinateur',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_ordinateur_detail")
     */
    public function detail(Ordinateurs $ordinateur): Response
    {
        return $this->render('app/ordinateur/detail.html.twig', [
            'active' => 'ordinateur',
            'datas' => $ordinateur
        ]);
    }
}

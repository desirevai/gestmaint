<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Techniciens;

/**
 * @Route("/dashboard/techniciens")
 */
class TechnicienController extends AbstractController
{
    /**
     * @Route("/", name="app_technicien")
     */
    public function technicien(): Response
    {
        $datas = $this->getDoctrine()->getRepository(Techniciens::class)->findBy([], ['id' => 'desc']);
        // dd($datas);
        return $this->render('app/technicien/index.html.twig', [
            'active' => 'technicien',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_technicien_detail")
     */
    public function detail(Techniciens $technicien): Response
    {
        return $this->render('app/technicien/detail.html.twig', [
            'active' => 'technicien',
            'datas' => $technicien
        ]);
    }
}

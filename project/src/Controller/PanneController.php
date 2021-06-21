<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pannes;

/**
 * @Route("/dashboard/pannes")
 */
class PanneController extends AbstractController
{
    /**
     * @Route("/", name="app_panne")
     */
    public function panne(): Response
    {
        $datas = $this->getDoctrine()->getRepository(Pannes::class)->findBy([], ['id' => 'desc']);
        // dd($datas);
        return $this->render('app/panne/index.html.twig', [
            'active' => 'panne',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_panne_detail")
     */
    public function detail(Pannes $panne): Response
    {

        // dd("detail intervention $intervention");
        // $datas = $this->getDoctrine()->getRepository(Interventions::class)->findAll();
        // dd($datas);
        return $this->render('app/panne/detail.html.twig', [
            'active' => 'panne',
            'datas' => $panne
        ]);
    }
}

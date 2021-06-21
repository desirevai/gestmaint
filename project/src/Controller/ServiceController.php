<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Services;

/**
 * @Route("/dashboard/services")
 */
class ServiceController extends AbstractController
{
    /**
     * @Route("/", name="app_service")
     */
    public function service(): Response
    {
        $datas = $this->getDoctrine()->getRepository(Services::class)->findBy([], ['id' => 'desc']);
        // dd($datas);
        return $this->render('app/service/index.html.twig', [
            'active' => 'service',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_service_detail")
     */
    public function detail(Services $service): Response
    {
        // $datas = $this->getDoctrine()->getRepository(Services::class)->findAll();
        // dd($datas);
        return $this->render('app/service/detail.html.twig', [
            'active' => 'service',
            'datas' => $service
        ]);
    }
}

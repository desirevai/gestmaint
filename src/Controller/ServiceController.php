<?php

namespace App\Controller;

use App\Entity\Services;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/dashboard/services")
 */
class ServiceController extends AbstractController
{
    /**
     * @Route("", name="app_service")
     *
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function service(Request $request, PaginatorInterface $paginator): Response
    {
        $donnes = $this->getDoctrine()->getRepository(Services::class)->findBy([], ['id' => 'desc']);
        $datas = $paginator->paginate(
            $donnes,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('app/service/index.html.twig', [
            'active' => 'service',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_service_detail")
     *
     * @param Services $service
     * @return Response
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

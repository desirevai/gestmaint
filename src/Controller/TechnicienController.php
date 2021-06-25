<?php

namespace App\Controller;

use App\Entity\Techniciens;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/dashboard/techniciens")
 */
class TechnicienController extends AbstractController
{
    /**
     * @Route("", name="app_technicien")
     *
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function technicien(Request $request, PaginatorInterface $paginator): Response
    {
        $donnes = $this->getDoctrine()->getRepository(Techniciens::class)->findBy([], ['id' => 'desc']);
        $datas = $paginator->paginate(
            $donnes,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('app/technicien/index.html.twig', [
            'active' => 'technicien',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_technicien_detail")
     *
     * @param Techniciens $technicien
     * @return Response
     */
    public function detail(Techniciens $technicien): Response
    {
        return $this->render('app/technicien/detail.html.twig', [
            'active' => 'technicien',
            'datas' => $technicien
        ]);
    }
}

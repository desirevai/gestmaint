<?php

namespace App\Controller;

use App\Entity\Pannes;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/dashboard/pannes")
 */
class PanneController extends AbstractController
{
    /**
     * @Route("", name="app_panne")
     *
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function panne(Request $request, PaginatorInterface $paginator): Response
    {
        $donnes = $this->getDoctrine()->getRepository(Pannes::class)->findBy([], ['id' => 'desc']);
        $datas = $paginator->paginate(
            $donnes,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('app/panne/index.html.twig', [
            'active' => 'panne',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_panne_detail")
     *
     * @param Pannes $panne
     * @return Response
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

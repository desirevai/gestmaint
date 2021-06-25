<?php

namespace App\Controller;

use App\Entity\Solutions;
use App\Entity\Interventions;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/dashboard/solutions")
 */
class SolutionController extends AbstractController
{
    /**
     * @Route("", name="app_solution")
     *
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function solution(Request $request, PaginatorInterface $paginator): Response
    {
        $donnes = $this->getDoctrine()->getRepository(Solutions::class)->findBy([], ['id' => 'desc']);
        $datas = $paginator->paginate(
            $donnes,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('app/solution/index.html.twig', [
            'active' => 'solution',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_solution_detail")
     *
     * @param Solutions $solution
     * @return Response
     */
    public function detail(Solutions $solution): Response
    {

        // dd("detail intervention $intervention");
        // $datas = $this->getDoctrine()->getRepository(Interventions::class)->findAll();
        // dd($datas);
        return $this->render('app/solution/detail.html.twig', [
            'active' => 'solution',
            'datas' => $solution
        ]);
    }
}

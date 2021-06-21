<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Solutions;

/**
 * @Route("/dashboard/solutions")
 */
class SolutionController extends AbstractController
{
    /**
     * @Route("/", name="app_solution")
     */
    public function solution(): Response
    {
        $datas = $this->getDoctrine()->getRepository(Solutions::class)->findBy([], ['id' => 'desc']);
        // dd($datas);
        return $this->render('app/solution/index.html.twig', [
            'active' => 'solution',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_solution_detail")
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

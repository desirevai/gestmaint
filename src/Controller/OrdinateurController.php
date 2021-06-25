<?php

namespace App\Controller;

use App\Entity\Ordinateurs;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/dashboard/ordinateurs")
 */
class OrdinateurController extends AbstractController
{
    /**
     * @Route("", name="app_ordinateur")
     *
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function ordinateur(Request $request, PaginatorInterface $paginator): Response
    {
        $donnes = $this->getDoctrine()->getRepository(Ordinateurs::class)->findBy([], ['id' => 'desc']);
        // dd($datas);
        $datas = $paginator->paginate(
            $donnes,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('app/ordinateur/index.html.twig', [
            'active' => 'ordinateur',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_ordinateur_detail")
     *
     * @param Ordinateurs $ordinateur
     * @return Response
     */
    public function detail(Ordinateurs $ordinateur): Response
    {
        return $this->render('app/ordinateur/detail.html.twig', [
            'active' => 'ordinateur',
            'datas' => $ordinateur
        ]);
    }
}

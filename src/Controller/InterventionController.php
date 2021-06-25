<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Interventions;
use App\Form\InterventionType;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/dashboard/interventions")
 */
class InterventionController extends AbstractController
{
    /**
     * @Route("", name="app_intervention")
     *
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function intervention(Request $request, PaginatorInterface $paginator): Response
    {
        $donnes = $this->getDoctrine()->getRepository(Interventions::class)->findBy([], ['id' => 'desc']);
        // dd($datas);

        $datas = $paginator->paginate(
            $donnes,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('app/intervention/index.html.twig', [
            'active' => 'intervention',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_intervention_detail")
     *
     * @param Interventions $intervention
     * @return Response
     */
    public function detail(Interventions $intervention): Response
    {

        // dd("detail intervention $intervention");
        // $datas = $this->getDoctrine()->getRepository(Interventions::class)->findAll();
        // dd($datas);
        return $this->render('app/intervention/detail.html.twig', [
            'active' => 'intervention',
            'datas' => $intervention
        ]);
    }

    /**
     * @Route("/edition", name="app_intervention_create")
     * @Route("/edition/{id}", name="app_intervention_edit")
     *
     * @param Interventions|null $intervention
     * @param Request $request
     * @return Response
     */
    public function create(?Interventions $intervention, Request $request): Response
    {
        if (!$intervention) {
            $intervention = new Interventions();
        }
        $form = $this->createForm(InterventionType::class, $intervention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($intervention);
            $em->flush();
            dd($intervention);
            if ($intervention->getId() == null) {
                $this->addFlash(
                    'success',
                    "L'intervention <strong>$intervention</strong> à été créée avec success."
                );
            } else {
                $this->addFlash(
                    'success',
                    "L'intervention <strong>$intervention</strong> à été mis à jours avec success."
                );
            }
            return $this->redirectToRoute('app_intervention');
        }
        return $this->render('app/intervention/create.html.twig', [
            'active' => 'intervention',
            'form' => $form->createView(),
        ]);
    }
}

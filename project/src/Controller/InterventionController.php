<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Interventions;
use App\Form\InterventionType;

/**
 * @Route("/dashboard/interventions")
 */
class InterventionController extends AbstractController
{
    /**
     * @Route("/", name="app_intervention")
     */
    public function intervention(): Response
    {
        $datas = $this->getDoctrine()->getRepository(Interventions::class)->findBy([], ['id'=>'desc']);
        // dd($datas);
        return $this->render('app/intervention/index.html.twig', [
            'controller_name' => 'intervention',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_intervention_detail")
     */
    public function detail(Interventions $intervention): Response
    {

        // dd("detail intervention $intervention");
        // $datas = $this->getDoctrine()->getRepository(Interventions::class)->findAll();
        // dd($datas);
        return $this->render('app/intervention/detail.html.twig', [
            'controller_name' => 'intervention',
            'datas' => $intervention
        ]);
    }

    /**
     * @Route("/edition", name="app_intervention_create")
     * @Route("/edition/{id}", name="app_intervention_edit")
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
            }else {
                $this->addFlash(
                    'success',
                    "L'intervention <strong>$intervention</strong> à été mis à jours avec success."
                );
            }
            return $this->redirectToRoute('app_intervention');

        }
        return $this->render('app/intervention/create.html.twig', [
            'controller_name' => 'intervention',
            'form' => $form->createView(),
        ]);
    }

}

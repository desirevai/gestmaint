<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Agents;
use App\Form\AgentsType;

/**
 * @Route("dashboard/inventaire")
 */
class InventaireController extends AbstractController
{
    /**
     * @Route("/", name="app_inventaire")
     * @Route("/{id}", name="app_inventaire_edit")
     */
    public function index(?Agents $agent, Request $request): Response
    {
        if (!$agent) {
            $agent = new Agents();
        }
        $form = $this->createForm(AgentsType::class, $agent);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {  
            // $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($agent);
            $em->flush();  
            
            $this->addFlash(
                'success',
                "Operation effectué avec success."
            );
            return $this->redirectToRoute('app_ordinateur');

        }
        return $this->render('app/inventaire/index.html.twig', [
            'controller_name' => 'InventaireController',
            'form' => $form->createView(),
        ]);
    }
}

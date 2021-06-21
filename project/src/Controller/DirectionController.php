<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Directions;
use App\Form\DirectionsType;

/**
 * @Route("/dashboard/directions")
 */
class DirectionController extends AbstractController
{

    /**
     * @Route("/", name="app_direction")
     */
    public function direction(): Response
    {
        $datas = $this->getDoctrine()->getRepository(Directions::class)->findBy([], ['id' => 'desc']);
        // dd($datas);
        return $this->render('app/direction/index.html.twig', [
            'active' => 'direction',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_direction_detail")
     */
    public function detail(Directions $direction): Response
    {

        return $this->render('app/direction/detail.html.twig', [
            'active' => 'direction',
            'datas' => $direction
        ]);
    }

    /**
     * @Route("/edition", name="app_direction_create")
     * @Route("/edition/{id}", name="app_direction_edit")
     */
    public function create(?Directions $direction, Request $request): Response
    {
        if (!$direction) {
            $direction = new Directions();
        }
        $form = $this->createForm(DirectionsType::class, $direction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($direction);
            $em->flush();
            if ($direction->getId() == null) {
                $this->addFlash(
                    'success',
                    "La direction <strong>$direction</strong> à été créée avec success."
                );
            } else {
                $this->addFlash(
                    'success',
                    "La direction <strong>$direction</strong> à été mis à jours avec success."
                );
            }
            return $this->redirectToRoute('app_direction');
        }
        return $this->render('app/direction/create.html.twig', [
            'active' => 'direction',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_direction_delete")
     */
    public function delete(Directions $direction): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($direction);
        $em->flush();
        $this->addFlash(
            'success',
            "La direction <strong>$direction</strong> à été supprimé avec success"
        );
        return $this->redirectToRoute('app_direction');
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Peripheriques;
use App\Form\PeripheriquesSimpleType;

/**
 * @Route("/dashboard/peripheriques")
 */
class PeripheriqueController extends AbstractController
{
    /**
     * @Route("/", name="app_peripherique")
     */
    public function peripherique(): Response
    {
        $datas = $this->getDoctrine()->getRepository(Peripheriques::class)->findBy([], ['id' => 'desc']);
        // dd($datas);
        return $this->render('app/peripherique/index.html.twig', [
            'active' => 'peripherique',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_peripherique_detail")
     */
    public function detail(Peripheriques $peripherique): Response
    {

        return $this->render('app/peripherique/detail.html.twig', [
            'active' => 'peripherique',
            'datas' => $peripherique
        ]);
    }

    /**
     * @Route("/edition", name="app_peripherique")
     * @Route("/edition/{id}", name="app_peripherique_edit")
     */
    public function edit(?Peripheriques $peripherique, Request $request): Response
    {
        if (!$peripherique) {
            $peripherique = new Peripheriques();
        }
        $form = $this->createForm(PeripheriquesSimpleType::class, $peripherique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($peripherique);
            $em->flush();

            $this->addFlash(
                'success',
                "Operation effectué avec success."
            );
            return $this->redirectToRoute('app_ordinateur');
        }
        return $this->render('app/peripherique/edit.html.twig', [
            'active' => 'peripherique',
            'form' => $form->createView(),
        ]);
    }
}

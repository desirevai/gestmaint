<?php

namespace App\Controller;

use App\Entity\Peripheriques;
use App\Form\PeripheriquesSimpleType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/dashboard/peripheriques")
 */
class PeripheriqueController extends AbstractController
{
    /**
     * @Route("", name="app_peripherique")
     *
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function peripherique(Request $request, PaginatorInterface $paginator): Response
    {
        $donnes = $this->getDoctrine()->getRepository(Peripheriques::class)->findBy([], ['id' => 'desc']);
        $datas = $paginator->paginate(
            $donnes,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('app/peripherique/index.html.twig', [
            'active' => 'peripherique',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_peripherique_detail")
     *
     * @param Peripheriques $peripherique
     * @return Response
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
     *
     * @param Peripheriques|null $peripherique
     * @param Request $request
     * @return Response
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

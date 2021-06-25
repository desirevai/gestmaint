<?php

namespace App\Controller;

use App\Entity\Agents;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/dashboard/agents")
 */
class AgentController extends AbstractController
{

    /**
     * @Route("", name="app_agent")
     *
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function agent(Request $request, PaginatorInterface $paginator): Response
    {
        $donnes = $this->getDoctrine()->getRepository(Agents::class)->findBy([], ['id' => 'desc']);
        $datas = $paginator->paginate(
            $donnes,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('app/agent/index.html.twig', [
            'active' => 'agent',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_agent_detail")
     *
     * @param Agents $agent
     * @return Response
     */
    public function detail(Agents $agent): Response
    {
        // $datas = $this->getDoctrine()->getRepository(Agents::class)->findAll();
        // dd($agent);
        return $this->render('app/agent/detail.html.twig', [
            'active' => 'agent',
            'datas' => $agent
        ]);
    }
}

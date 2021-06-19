<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Agents;

/**
 * @Route("/dashboard/agents")
 */
class AgentController extends AbstractController
{

    /**
     * @Route("/", name="app_agent")
     */
    public function agent(): Response
    {
        $datas = $this->getDoctrine()->getRepository(Agents::class)->findBy([], ['id'=>'desc']);
        // dd($datas);
        return $this->render('app/agent/index.html.twig', [
            'controller_name' => 'agent',
            'datas' => $datas
        ]);
    }
    
    /**
     * @Route("/detail/{id}", name="app_agent_detail")
     */
    public function detail(Agents $agent): Response
    {
        // $datas = $this->getDoctrine()->getRepository(Agents::class)->findAll();
        // dd($agent);
        return $this->render('app/agent/detail.html.twig', [
            'controller_name' => 'agent',
            'datas' => $agent
        ]);
    }
}

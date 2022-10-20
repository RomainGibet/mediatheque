<?php

namespace App\Controller;

use App\Repository\LpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LpController extends AbstractController
{
    /**
     * @Route("/lp", name="app_lp")
     */
    public function index(): Response
    {
        return $this->render('lp/index.html.twig', [
            'controller_name' => 'LpController',
        ]);
    }

     /**
     * @Route("/lp_list", name="app_lp_list", methods={"GET"})
     * 
     * @return Response
     */

    public function show(LpRepository $lpRepository): Response
    
    { 

        $lpList = $lpRepository->findAll();

        return $this->render('collection/lp_list.html.twig', [
            'lpList' => $lpList,
        ]);

    }
}

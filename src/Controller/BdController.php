<?php

namespace App\Controller;

use App\Repository\BdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BdController extends AbstractController
{
    /**
     * @Route("/bd", name="app_bd")
     */
    public function index(): Response
    {
        return $this->render('bd/index.html.twig', [
            'controller_name' => 'BdController',
        ]);
    }

    /**
     * @Route("/bd_list", name="app_bd_list", methods={"GET"})
     * 
     * @return Response
     */

    public function show(BdRepository $bdRepository): Response
    
    { 

        $bdList = $bdRepository->findAll();

        return $this->render('collection/bd_list.html.twig', [
            'bdList' => $bdList,
        ]);

    }
}

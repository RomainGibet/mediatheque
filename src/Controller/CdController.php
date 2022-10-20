<?php

namespace App\Controller;

use App\Repository\CdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CdController extends AbstractController
{
    /**
     * @Route("/cd", name="app_cd")
     */
    public function index(): Response
    {
        return $this->render('cd/index.html.twig', [
            'controller_name' => 'CdController',
        ]);
    }

    /**
     * @Route("/cd_list", name="app_cd_list", methods={"GET"})
     * 
     * @return Response
     */

    public function show(CdRepository $cdRepository): Response
    
    { 

        $cdList = $cdRepository->findAll();

        return $this->render('collection/cd_list.html.twig', [
            'cdList' => $cdList,
        ]);

    }
}

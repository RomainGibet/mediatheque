<?php

namespace App\Controller;

use App\Repository\ComicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComicController extends AbstractController
{
    /**
     * @Route("/comic", name="app_comic")
     */
    public function index(): Response
    {
        return $this->render('comic/index.html.twig', [
            'controller_name' => 'ComicController',
        ]);
    }

    /**
     * @Route("/comic_list", name="app_comic_list", methods={"GET"})
     * 
     * @return Response
     */

    public function show(ComicRepository $comicRepository): Response
    
    { 

        $comicList = $comicRepository->findAll();

        return $this->render('collection/comic_list.html.twig', [
            'comicList' => $comicList,
        ]);

    }
}

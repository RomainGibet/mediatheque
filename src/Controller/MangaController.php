<?php

namespace App\Controller;

use App\Repository\MangaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MangaController extends AbstractController
{
    /**
     * @Route("/manga", name="app_manga")
     */
    public function index(): Response
    {
        return $this->render('manga/index.html.twig', [
            'controller_name' => 'MangaController',
        ]);
    }

    /**
     * @Route("/manga_list", name="app_manga_list", methods={"GET"})
     * 
     * @return Response
     */

    public function show(MangaRepository $mangaRepository): Response
    
    { 

        $mangaList = $mangaRepository->findAll();

        return $this->render('collection/manga_list.html.twig', [
            'mangaList' => $mangaList,
        ]);

    }
}

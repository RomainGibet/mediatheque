<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/book", name="app_book")
     */
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }


    /**
     * @Route("/book_list", name="app_book_list", methods={"GET"})
     * 
     * @return Response
     */

    public function show(BookRepository $bookRepository): Response
    
    {

        $bookList = $bookRepository->findAll();

        return $this->render('collection/book_list.html.twig', [
            'bookList' => $bookList,
        ]);

    }
}

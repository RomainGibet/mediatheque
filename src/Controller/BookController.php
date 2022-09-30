<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\User;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/add_book", name="app_add_book", methods={"GET","POST"})
     * 
     * @return Response
     */

    public function add(
        User $user,
        BookRepository $bookRepository,
        Request $request,
        ManagerRegistry $doctrine
    ) 
    {
        $book = new Book;
        $form = $this->createForm(AddBookType::class, $book);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->IsValid())
        {
            
            $book->addUser($this->getUser());
            $user->setBookCount(+1);


            $bookRepository->add($book, true);
            $this->addFlash('success', 'Livre rajouté');

            return $this->redirectToRoute('app_book_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/partials/modals_add.html.twig', [

            'book' => $book,
            'form' => $form

        ]);

        
    }
}

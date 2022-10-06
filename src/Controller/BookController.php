<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\User;
use App\Form\AddBookType;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\DBAL\Connection;


class BookController extends AbstractController
{
    

    /**
     * @Route("book_list/{user_id}/", name="app_book_list", methods={"GET"})
     * 
     * 
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     * 
     * 
     * @return Response
     */

    public function show(BookRepository $bookRepository, ManagerRegistry $doctrine, int $user_id): Response

    {


        // $bookList = $bookRepository->findAll();
        $bookList = $bookRepository->fetchBooksUser($user_id);
        

        return $this->render('collection/book_list.html.twig', [
            'bookList' => $bookList,
            // 'user_id' => $user_id
        ]);
    }



    

    /**
     * @Route("add_book/{user_id}", name="app_add_book", methods={"GET","POST"})
     * 
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     * 
     * 
     * @return Response
     */

    public function add(
        
        BookRepository $bookRepository,
        Request $request,
        ManagerRegistry $doctrine,
        int $user_id
    ) : Response
  
      {  
        
       
        $book = new Book;
        $form = $this->createForm(AddBookType::class, $book);
        $form->handleRequest($request);
        

        if($form->isSubmitted() && $form->IsValid())
        {
            $user = $this->getUser();
            
            $book->addUser($user);
            $user->addBook($book);
            $user->setBookCount(+1);


            $bookRepository->add($book, true);
            $this->addFlash('success', 'Livre rajouté');

            $em = $doctrine->getManager();
            $em->persist($book);
            
            $em->flush();

            return $this->redirectToRoute('app_book_list', ['user_id' => $user_id], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/book/addBookForm.html.twig', [

            'book' => $book,
            'form' => $form,
            'user_id' => $user_id

        ]);

        
    }
}

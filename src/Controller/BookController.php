<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\User;
use App\Form\AddBookType;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



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

    public function show(BookRepository $bookRepository, int $user_id): Response

    {

        $current_user = $this->getUser();
        $current_user_id = $current_user->getId();
        if ($current_user_id === $user_id)  
        {

            $bookList = $bookRepository->fetchBooksUser($user_id);

            return $this->render('collection/book_list.html.twig', [
            'bookList' => $bookList,
            'user_id' => $user_id
            
        ]);
        }

        return $this->render('404.html.twig');

        // $bookList = $bookRepository->findAll();
        


        
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
    ): Response {


        $book = new Book;
        $form = $this->createForm(AddBookType::class, $book);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->IsValid()) {

            $book->addUser($this->getUser());
            
            $bookRepository->add($book, true);
            $this->addFlash('success', 'Livre rajouté');

            $em = $doctrine->getManager();
            $em->persist($book);

            $em->flush();

            return $this->redirectToRoute(
                'app_book_list',
                [
                    'user_id' => $user_id
                ],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('/book/addBookForm.html.twig', [

            'book' => $book,
            'form' => $form,
            'user_id' => $user_id

        ]);
    }


    /**
     * @Route("edit_book/{user_id}/{book_id}", name="app_edit_book", methods={"GET","POST","PUT"},
     * requirements={"book_id"="\d+"})
     * 
     * @ParamConverter("book", options={"id" = "book_id"})
     * @ParamConverter("user", options={"id" = "user_id"})
     * 
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     * 
     * 
     * @return Response
     */

    public function edit(
 
        Book $book,
        User $user,
        BookRepository $bookRepository,
        Request $request,
        ManagerRegistry $doctrine,
        int $user_id
        
    ): Response {
        // dd($request);


        $form = $this->createForm(AddBookType::class, $book);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->IsValid()) {

    
            $bookRepository->add($book, true);
           

            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute(
                'app_book_list',
                [
                    'user_id' => $user->getId(),
                    
                ],
                Response::HTTP_SEE_OTHER
            );

        }

        return $this->renderForm('/book/editBookForm.html.twig', [

            'book_id' => $book->getId(),
            'form' => $form,
            // 'user' => $user,
            'user_id' => $user_id

        ]);

    }



    /**
     * @Route("delete_book/{user_id}/{book_id}", name="app_delete_book", methods={"GET","POST","DELETE"})
     * 
     * @ParamConverter("book", options={"id" = "book_id"})
     * @ParamConverter("user", options={"id" = "user_id"})
     * 
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     * 
     * 
     * @return Response
     */

    public function delete(

        Request $request, 
        Book $book, 
        User $user,
        BookRepository $bookRepository
        ): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $bookRepository->remove($book, true);
        }

        return $this->redirectToRoute('app_book_list', [

            "user_id" => $user->getId(),
        
        ], Response::HTTP_SEE_OTHER);
    }


}

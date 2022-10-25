<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\ComicRepository;
use App\Entity\Comic;
use App\Entity\User;
use App\Form\AddComicType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\Persistence\ManagerRegistry;

class ComicController extends AbstractController
{
    /**
     * @Route("/comic_list/{user_id}/", name="app_comic_list", methods={"GET"})
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     *
     * @return Response
     */

    public function show(
        ComicRepository $comicRepository,
        int $user_id
    ): Response 
    {
        $current_user_id = $this->getUser()->getId();

        if ($current_user_id === $user_id) {
            $comicList = $comicRepository->fetchComicUser($user_id);


            return $this->render('collection/comic_list.html.twig', [
                'comicList' => $comicList,
                'user_id' => $user_id
            ]);
        }

        return $this->render('404.html.twig');
    }


/**
     * @Route("add_comic/{user_id}", name="app_add_comic", methods={"GET","POST"})
     * 
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     * 
     * 
     * @return Response
     */

    public function add(

        // User $user,
        ComicRepository $comicRepository,
        UserRepository $userRepository,
        Request $request,
        ManagerRegistry $doctrine,
        int $user_id
    ): Response {


        $comic = new Comic;
        $form = $this->createForm(AddComicType::class, $comic);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->IsValid()) {

            $comic->addUser($this->getUser());

            $comicRepository->add($comic, true);
            $this->addFlash('success', 'Livre rajouté');
            $userRepository->comicCountsAdd($this->getUser());

            $em = $doctrine->getManager();
            $em->persist($comic);

            $em->flush();

            return $this->redirectToRoute(
                'app_comic_list',
                [
                    'user_id' => $user_id
                ],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('/comic/addComicForm.html.twig', [

            'comic' => $comic,
            'form' => $form,
            'user_id' => $user_id

        ]);
    }

     /**
     * @Route("edit_comic/{user_id}/{comic_id}", name="app_edit_comic", methods={"GET","POST","PUT"},
     * requirements={"comic_id"="\d+"})
     * 
     * @ParamConverter("comic", options={"id" = "comic_id"})
     * @ParamConverter("user", options={"id" = "user_id"})
     * 
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     * 
     * 
     * @return Response
     */

    public function edit(
 
        Comic $comic,
        User $user,
        ComicRepository $comicRepository,
        Request $request,
        ManagerRegistry $doctrine,
        int $user_id
        
    ): Response {
        // dd($request);


        $form = $this->createForm(AddComicType::class, $comic);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->IsValid()) {

    
            $comicRepository->add($comic, true);
           

            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute(
                'app_comic_list',
                [
                    'user_id' => $user->getId(),
                    
                ],
                Response::HTTP_SEE_OTHER
            );

        }

        return $this->renderForm('/comic/editComicForm.html.twig', [

            'comic_id' => $comic->getId(),
            'form' => $form,
            // 'user' => $user,
            'user_id' => $user_id

        ]);

    }



    /**
     * @Route("delete_comic/{user_id}/{comic_id}", name="app_delete_comic", methods={"GET","POST","DELETE"})
     * 
     * @ParamConverter("comic", options={"id" = "comic_id"})
     * @ParamConverter("user", options={"id" = "user_id"})
     * 
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     * 
     * 
     * @return Response
     */

    public function delete(

        Request $request, 
        Comic $comic, 
        User $user,
        UserRepository $userRepository,
        ComicRepository $comicRepository
        ): Response

    {
        if ($this->isCsrfTokenValid('delete'.$comic->getId(), $request->request->get('_token'))) {
            $comicRepository->remove($comic, true);
            $userRepository->comicCountsDelete($this->getUser());
        }

        return $this->redirectToRoute('app_comic_list', [

            "user_id" => $user->getId(),
        
        ], Response::HTTP_SEE_OTHER);
    }

}

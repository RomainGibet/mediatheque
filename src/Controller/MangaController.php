<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\MangaRepository;
use App\Entity\Manga;
use App\Entity\User;
use App\Form\AddMangaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\Persistence\ManagerRegistry;

class MangaController extends AbstractController
{

    /**
     * @Route("/manga_list/{user_id}", name="app_manga_list", methods={"GET"})
     * 
     * @return Response
     */

    public function show(
        MangaRepository $mangaRepository,
        int $user_id
        
        ): Response
    
    { 
        $current_user_id = $this->getUser()->getId();

        if ($current_user_id === $user_id) {
            $mangaList = $mangaRepository->fetchMangaUser($user_id);


            return $this->render('collection/manga_list.html.twig', [
                'mangaList' => $mangaList,
                'user_id' => $user_id
            ]);
        }

        return $this->render('404.html.twig');

    }

    /**
     * @Route("add_manga/{user_id}", name="app_add_manga", methods={"GET","POST"})
     * 
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     * 
     * 
     * @return Response
     */

    public function add(

        // User $user,
        MangaRepository $mangaRepository,
        UserRepository $userRepository,
        Request $request,
        ManagerRegistry $doctrine,
        int $user_id
    ): Response {


        $manga = new Manga;
        $form = $this->createForm(AddMangaType::class, $manga);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->IsValid()) {

            $manga->addUser($this->getUser());

            $mangaRepository->add($manga, true);
            $this->addFlash('success', 'Livre rajouté');
            $userRepository->mangaCountsAdd($this->getUser());

            $em = $doctrine->getManager();
            $em->persist($manga);

            $em->flush();

            return $this->redirectToRoute(
                'app_manga_list',
                [
                    'user_id' => $user_id
                ],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('/manga/addMangaForm.html.twig', [

            'manga' => $manga,
            'form' => $form,
            'user_id' => $user_id

        ]);
    }

     /**
     * @Route("edit_manga/{user_id}/{manga_id}", name="app_edit_manga", methods={"GET","POST","PUT"},
     * requirements={"manga_id"="\d+"})
     * 
     * @ParamConverter("manga", options={"id" = "manga_id"})
     * @ParamConverter("user", options={"id" = "user_id"})
     * 
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     * 
     * 
     * @return Response
     */

    public function edit(
 
        Manga $manga,
        User $user,
        MangaRepository $mangaRepository,
        Request $request,
        ManagerRegistry $doctrine,
        int $user_id
        
    ): Response {
        // dd($request);


        $form = $this->createForm(AddMangaType::class, $manga);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->IsValid()) {

    
            $mangaRepository->add($manga, true);
           

            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute(
                'app_manga_list',
                [
                    'user_id' => $user->getId(),
                    
                ],
                Response::HTTP_SEE_OTHER
            );

        }

        return $this->renderForm('/manga/editMangaForm.html.twig', [

            'manga_id' => $manga->getId(),
            'form' => $form,
            // 'user' => $user,
            'user_id' => $user_id

        ]);

    }



    /**
     * @Route("delete_manga/{user_id}/{manga_id}", name="app_delete_manga", methods={"GET","POST","DELETE"})
     * 
     * @ParamConverter("manga", options={"id" = "manga_id"})
     * @ParamConverter("user", options={"id" = "user_id"})
     * 
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     * 
     * 
     * @return Response
     */

    public function delete(

        Request $request, 
        Manga $manga, 
        User $user,
        UserRepository $userRepository,
        MangaRepository $mangaRepository
        ): Response

    {
        if ($this->isCsrfTokenValid('delete'.$manga->getId(), $request->request->get('_token'))) {
            $mangaRepository->remove($manga, true);
            $userRepository->mangaCountsDelete($this->getUser());
        }

        return $this->redirectToRoute('app_manga_list', [

            "user_id" => $user->getId()
        ], Response::HTTP_SEE_OTHER);
    }
}

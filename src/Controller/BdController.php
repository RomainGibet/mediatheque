<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\BdRepository;
use App\Entity\Bd;
use App\Entity\User;
use App\Form\AddBdType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\Persistence\ManagerRegistry;

class BdController extends AbstractController
{

    /**
     * @Route("/bd_list/{user_id}/", name="app_bd_list", methods={"GET"})
     * 
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     * 
     * @return Response
     */

    public function show(
        BdRepository $bdRepository,
        int $user_id
    ): Response {

        $current_user_id = $this->getUser()->getId();

        if ($current_user_id === $user_id) {
            $bdList = $bdRepository->fetchBdUser($user_id);


            return $this->render('collection/bd_list.html.twig', [
                'bdList' => $bdList,
                'user_id' => $user_id
            ]);
        }

        return $this->render('404.html.twig');
    }

    /**
     * @Route("add_bd/{user_id}", name="app_add_bd", methods={"GET","POST"})
     * 
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     * 
     * 
     * @return Response
     */

    public function add(

        // User $user,
        BdRepository $bdRepository,
        UserRepository $userRepository,
        Request $request,
        ManagerRegistry $doctrine,
        int $user_id
    ): Response {


        $bd = new Bd;
        $form = $this->createForm(AddBdType::class, $bd);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->IsValid()) {

            $bd->addUser($this->getUser());

            $bdRepository->add($bd, true);
            $this->addFlash('success', 'Livre rajouté');
            $userRepository->bdCountsAdd($this->getUser());

            $em = $doctrine->getManager();
            $em->persist($bd);

            $em->flush();

            return $this->redirectToRoute(
                'app_bd_list',
                [
                    'user_id' => $user_id
                ],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('/bd/addBdForm.html.twig', [

            'bd' => $bd,
            'form' => $form,
            'user_id' => $user_id

        ]);
    }

     /**
     * @Route("edit_bd/{user_id}/{bd_id}", name="app_edit_bd", methods={"GET","POST","PUT"},
     * requirements={"bd_id"="\d+"})
     * 
     * @ParamConverter("bd", options={"id" = "bd_id"})
     * @ParamConverter("user", options={"id" = "user_id"})
     * 
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     * 
     * 
     * @return Response
     */

    public function edit(
 
        Bd $bd,
        User $user,
        BdRepository $bdRepository,
        Request $request,
        ManagerRegistry $doctrine,
        int $user_id
        
    ): Response {
        // dd($request);


        $form = $this->createForm(AddBdType::class, $bd);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->IsValid()) {

    
            $bdRepository->add($bd, true);
           

            $em = $doctrine->getManager();
            $em->flush();

            return $this->redirectToRoute(
                'app_bd_list',
                [
                    'user_id' => $user->getId(),
                    
                ],
                Response::HTTP_SEE_OTHER
            );

        }

        return $this->renderForm('/bd/editBdForm.html.twig', [

            'bd_id' => $bd->getId(),
            'form' => $form,
            // 'user' => $user,
            'user_id' => $user_id

        ]);

    }



    /**
     * @Route("delete_bd/{user_id}/{bd_id}", name="app_delete_bd", methods={"GET","POST","DELETE"})
     * 
     * @ParamConverter("bd", options={"id" = "bd_id"})
     * @ParamConverter("user", options={"id" = "user_id"})
     * 
     * @IsGranted("ROLE_USER", message="No access! Get out!")
     * 
     * 
     * @return Response
     */

    public function delete(

        Request $request, 
        Bd $bd, 
        User $user,
        UserRepository $userRepository,
        BdRepository $bdRepository
        ): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bd->getId(), $request->request->get('_token'))) {
            $bdRepository->remove($bd, true);
            $userRepository->bdCountsDelete($this->getUser());
        }

        return $this->redirectToRoute('app_bd_list', [

            "user_id" => $user->getId(),
        
        ], Response::HTTP_SEE_OTHER);
    }

}

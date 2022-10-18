<?php

namespace App\Controller;

use App\Repository\BdRepository;
use App\Entity\Bd;
use App\Repository\UserRepository;
use App\Form\AddBookType;
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
        $form = $this->createForm(AddBookType::class, $bd);
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
                'app_book_list',
                [
                    'user_id' => $user_id
                ],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('/book/addBookForm.html.twig', [

            'book' => $bd,
            'form' => $form,
            'user_id' => $user_id

        ]);
    }
}

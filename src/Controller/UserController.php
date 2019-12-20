<?php

namespace App\Controller;

use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="show_user")
     */
    public function show()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if( isset($user) ){

            return $this->render('user/show.html.twig', [
                'user' => $user,
            ]);
        }

        return $this->render('default/index.html.twig');

    }

    /**
     * @Route("/user/edit", name="edit_user")
     */
    public function edit(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if( isset($user) ){

            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            if ( $form->isSubmitted() && $form->isValid() ) {
                $user = $form->getData();
    
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
    
                return $this->render('user/show.html.twig', [
                    'user' => $user,
                ]);
            }
    
            return $this->render('user/edit.html.twig', [
                'form' => $form->createView(),
            ]);
        }
        
        return $this->render('user/show.html.twig');
    }
}

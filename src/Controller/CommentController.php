<?php

namespace App\Controller;

use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment", name="comment")
     */
    public function index()
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }

    /**
     * Supprime un commentaire
     * 
     * @Route("/comment/delete/{id}", name="delete_comment", requirements={"id"="\d+"})
     * @param id $id, l'id du produit à supprimer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository(Comment::class)->findOneBy(['id'=>$id]);

        $idProduct = $comment->getProduct()->getId();

        if (!$comment) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        $em->remove($comment);
        $em->flush();

        return $this->redirectToRoute('show_product', ['id'=>$idProduct]);
    }
}

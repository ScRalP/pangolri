<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Cart;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $carts = $em->getRepository(Cart::class)->findAll();

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'carts' => $carts
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Cart;
use App\Entity\Product;
use App\Entity\ProductCart;

class CartController extends AbstractController
{

    private $products;
    /**
     * @Route("/cart", name="cart")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();


        $user = $this->get('security.token_storage')->getToken()->getUser();
        $productCart = $user->getCart()->getProductCart();
        foreach($productCart as $nbProducts){
            $products []= $nbProducts->getProduct();
        }

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'cartUser' => $products
        ]);
    }

    /**
     * Affichage de la fiche d'un produit
     * 
     * @Route("/product/{id}", name="add_product", requirements={"id"="\d+"})
     */
    public function add_product(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $cart = $user->getCart();

        if($cart==null){
            $user->setCart(new Cart());
            $cart->$user->getCart();
            $cart->setPrice(0);
        }

        $product = $em->getRepository(Product::class)->find($id);

        $productCart = new ProductCart();
        $productCart->setCart($cart)
                    ->setProduct($product);

        $cart->addProductCart($productCart);

        $em->persist($cart);
        $em->persist($productCart);
        $em->flush();

        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }


}

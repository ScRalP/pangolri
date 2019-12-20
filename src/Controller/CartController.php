<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cart;
use App\Entity\Product;
use App\Entity\ProductCart;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="show_cart")
     */
    public function show()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $cart = $user->getCart();
        $products = [];

        $productCarts = $cart->getProductCart();
        foreach($productCarts as $productCart){
            array_push( $products, $productCart->getProduct() );
        }

        return $this->render('cart/show.html.twig', [
            'cart' => $cart,
            'products' => $products
        ]);
    }

    /**
     * Affichage de la fiche d'un produit
     * 
     * @Route("/product/add/{id}", name="add_product", requirements={"id"="\d+"})
     */
    public function addProduct(int $id)
    {
        //Recuperer le client
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);
        
        $user = $this->get('security.token_storage')->getToken()->getUser();

        //récupérer son panier
        $cart = $user->getCart();

        //Si son panier est null on lui en créer un nouveau
        if($cart==null){
            $cart = $user->setCart(new Cart());
        }

        //On regarde si le produit existe déjà dans le panier
        $existingProductCart = null;
        $productCarts = $em->getRepository(ProductCart::class)->findAll();
        foreach($productCarts as $productCart){
            if( $productCart->getProduct() == $product && $productCart->getCart() == $cart ){
                $existingProductCart = $productCart;
            }
        }

        //Si le produit existe déjà on incrémenta la quantité
        if( $existingProductCart != null ){
            $productCart = $existingProductCart;
            $productCart->setQuantity( $productCart->getQuantity()+1 );
        } else{ //Sinon on l'ajoute avec une quantité de 1
            $productCart = new ProductCart();
            $productCart->setCart($cart);
            $productCart->setProduct($product);
            $productCart->setQuantity(1);
    
            $cart->addProductCart($productCart);
        }

        $em->persist($cart);
        $em->persist($productCart);
        $em->flush();

        return $this->redirectToRoute('show_cart');
    }


}

<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{

    /**
     * Affichage de l'ensemble des produits
     * 
     * @Route("/product", name="product_list")
     */
    public function index(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $products = [];

        //On fait la recherce avec paramètre
        if( isset($_GET['search']) && $_GET['search']!=null ){
            $allProducts = $em->getRepository(Product::class)->findAll();

            foreach($allProducts as $product){
                if( strpos( $product->getTitle(), $_GET['search'] ) !== false ){
                    array_push($products, $product);
                }
            }

        }
        else{ //Pas de recherche, affichage de tout les éléments
            $products = $em->getRepository(Product::class)->findAll();
        }

        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }
    
    /**
     * Affichage de la fiche d'un produit
     * 
     * @Route("/product/{id}", name="show_product", requirements={"id"="\d+"})
     */
    public function show(int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository(Product::class)->find($id);

        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * Creer un nouveau produit
     * 
     * @Route("/product/new", name="new_product")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() ) {
            $product = $form->getData();

            $product->setRate(0);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

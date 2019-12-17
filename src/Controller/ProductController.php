<?php

namespace App\Controller;

use App\Entity\Category;
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
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository(Product::class)->findAll();
        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'page_category' => -1
        ]);
    }

    /**
     * Affichage des produits par categorie
     * 
     * @Route("categorie{id}", name="show_categ", requirements={"id"="\d+"})
     */
    public function show_categ(int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository(Category::class)->findAll();
        $category = $em->getRepository(Category::class)->find($id);

        return $this->render('product/indexCategory.html.twig', [
            'categories' => $categories,
            'page_category' => $category
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
        $entity_manager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setTitle('test');
        $product->setDescription('fuck its a test'); 

        $category = new Category();
        $category->setName('FUUUUUCK');
        $product->addCategory($category);

        $form = $this->createForm(ProductType::class, $product, [
            'entity_manager' => $entity_manager,
        ]);
        $form->handleRequest($request);


        if ( $form->isSubmitted() ) {
            dump($product);
        }

        return $this->render('product/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

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
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $products   = [];
        $categories = $em->getRepository(Category::class)->findAll();

        //Si on recherche un produit par titre
        if( isset($_GET['search']) && $_GET['search']!=null ){
            $allProducts = $em->getRepository(Product::class)->findAll();

            foreach($allProducts as $product){
                if( strpos( $product->getTitle(), $_GET['search'] ) !== false ){
                    array_push($products, $product);
                }
            }
            
            return $this->render('product/index.html.twig', [
                'products'   => $products,
                'categories' => $categories
            ]);
        }

        $products   = $em->getRepository(Product::class)->findAll();

        return $this->render('product/index.html.twig', [
            'products'   => $products,
            'categories' => $categories
        ]);
    }
    
    /**
     * Affichage de l'ensemble des produits faisant partis d'une catégorie
     * 
     * @Route("/product/category/{categ}", name="product_categ")
     * @param categ, la catégorie que dont l'on souhaite voir les produits
     */
    public function getProductsByCategory($categ)
    {
        $em = $this->getDoctrine()->getManager();
        $products = [];

        //Si on recherche un produit par categorie
        if( isset($categ) ){
            $allProducts = $em->getRepository(Product::class)->findAll();

            foreach($allProducts as $product){
                foreach($product->getCategories() as $category){
                    if( $category == $categ ){           //Si le produit possède la catégorie
                        array_push($products, $product); //On l'ajoute à la liste
                        break;
                    }
                }
            }
            
            return $this->render('product/index.html.twig', [
                'products' => $products
            ]);
        }
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

            $images = $form->get('images')->getExtraData();
            
            $product = $form->getData();

            $product->setImages($images);
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

    
    /**
     * Edit un produit
     * 
     * @Route("/product/edit/{id}", name="edit_product", requirements={"id"="\d+"})
     * @param Request $request
     * @param id $id, l'id du produit à modifier
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->findOneBy(['id'=>$id]);

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid() ) {

            $images = $form->get('images')->getExtraData();
            
            $product = $form->getData();

            $product->setImages($images);
            $product->setRate(0);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Supprime un  produit
     * 
     * @Route("/product/delete/{id}", name="delete_product", requirements={"id"="\d+"})
     * @param Request $request
     * @param id $id, l'id du produit à supprimer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->findOneBy(['id'=>$id]);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute('product_list');
    }

}

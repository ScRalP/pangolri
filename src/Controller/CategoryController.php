<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category_list")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;

class DefaultController extends AbstractController
{
    /**
     * Affichage de la page d'accueil
     * 
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', []);
    }


}

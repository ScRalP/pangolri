<?php
// src/Twig/AppExtension.php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ImageExtension extends AbstractExtension
{
    private $kernelProjectDir;

    // le constructeur indique que nous avons ici besoin d'un paramètre, le kernelProjectDir.
    // Nous allons passer ce paramètre en le déclarant dans notre fichier config/services.yaml. 
    // Il s'agit d'un paramètre par défaut introduit dans Symfony 4.
    public function __construct(string $kernelProjectDir)
    {
        $this->kernelProjectDir = $kernelProjectDir;
    }
    
    public function getFunctions()
    {
        return [
            new TwigFunction('product_image_exist', array($this, 'product_image_exist')),
            new TwigFunction('product_image'      , array($this, 'product_image')      ),
        ];
    }

    /**
     * @param img, le nom de l'image en paramètre
     */
    public function product_image_exist(string $img)
    {
        return file_exists($this->kernelProjectDir."/public/build/images/products/".$img) ? true : false;
    }

    /**
     * Renvoie le chemin vers l'image
     * @param img, le nom de l'image
     */
    public function product_image(string $img){
        return "/build/images/products/".$img;
    }
}
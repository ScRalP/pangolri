<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0; $i<10; $i++) {
            $product = new Product();
            $product->setTitle("produit n°$i")
                ->setDescription("description intellectuelle et utile du produit numéro $i")
                ->setPrice(rand(10, 100))
                ->setRate(rand(1, 5))
                ->setStock(rand(1, 50))
                ->setBrand('matel')
                ->setImages("build\images\products\canard.jpeg");
            $manager->persist($product);
        }
        $manager->flush();
    }
}

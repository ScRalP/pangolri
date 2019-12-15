<?php

namespace App\DataFixtures;

use App\Entity\Cart;
use App\Entity\CreditCard;
use App\Entity\Delivery;
use App\Entity\Order;
use App\Entity\Payment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0; $i<10; $i++){
            $user = new User();
            $order = new Order();
            $delivery = new Delivery();
            $creditCard = new CreditCard();
            $payement = new Payment();
            $user->setFirstName("prenom utilisateur n°$i")
                 ->setLastName("nom de famille de utilisateur n°$i")
                 ->setAddress("" . rand(1, 100) . "rue huine, 76600 LE HAVRE")
                 ->setAge(rand(18, 100))
                 ->setCellphone("06" . rand(10, 99) . "" . rand(10,99) . "" . rand(10, 99) . "" . rand(10,99) . "" )
                 ->setEmail("email$i@hotmail.fr")
                 ->setPassword("password$i")
                 ->setUsername("user$i");

            $manager->persist($user);
        }


        $manager->flush();
    }
}

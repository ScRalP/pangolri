<?php

namespace App\DataFixtures;

use App\Entity\Cart;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\CreditCard;
use App\Entity\Delivery;
use App\Entity\Order;
use App\Entity\Payment;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\Wishlist;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixture extends Fixture
{

    public $products;
    public $users;
    public $orders;
    public $creditcards;
    public $carts;

    public function load(ObjectManager $manager)
    {
        $this->loadProducts($manager);
        $this->loadCategories($manager);
        $this->loadUsers($manager);
        $this->loadOrder($manager);
        //$this->loadCart($manager);
        $this->loadComment($manager);
        //$this->loadCreditCard($manager);
        $this->loadPayment($manager);
       // $this->loadDelivery($manager);
        //$this->loadWishlist($manager);

    }

    public function loadProducts(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setTitle("produit n°$i")
                ->setDescription("description intellectuelle et utile du produit numéro $i")
                ->setPrice(rand(10, 100))
                ->setRate(rand(1, 5))
                ->setStock(rand(1, 50))
                ->setBrand('matel')
                ->setImages(["build\images\products\canard.jpeg"]);
            $manager->persist($product);
            $products[] = $product;
        }
        $manager->flush();
    }

    public function loadCategories(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName("categorie n°$i");
            if($this->products[$i]!=null) {
                $category->addProduct($this->products[$i + 1]);
            }
            $manager->persist($category);
        }


        $manager->flush();
    }

    public function loadUsers(ObjectManager $manager)
    {
        for($i=0; $i<10; $i++){
            $user = new User();
            $user->setFirstName("prenom utilisateur n°$i")
                ->setLastName("nom de famille de utilisateur n°$i")
                ->setAddress("" . rand(1, 100) . "rue huine, 76600 LE HAVRE")
                ->setAge(rand(18, 100))
                ->setCellphone("06" . rand(10, 99) . "" . rand(10,99) . "" . rand(10, 99) . "" . rand(10,99) . "" )
                ->setEmail("email$i@hotmail.fr")
                ->setPassword("password$i")
                ->setUsername("user$i");

            $manager->persist($user);
            $users[]=$user;
        }


        $manager->flush();
    }

    public function loadOrder(ObjectManager $manager){
        for($i=0;$i<10;$i++){
            $order= new Order();
            $order->setUser($this->users[$i]);
            $order->setDate(new DateTime('now'));
            $manager->persist($order);
            $orders[]=$order;
        }
        $manager->flush();
    }

    /*public function loadCart(ObjectManager $manager)
    {
        for($i=0;$i<10;$i++){
            $cart = new Cart();
            //$cart->setUser($this->users[$i]);
            $cart->addProduct($this->products[$i]);
            $cart->setPrice(rand(10, 100));
            $manager->persist($cart);
        }
        $manager->flush();
    }*/

    public function loadComment(ObjectManager $manager)
    {
        for($i=0;$i<20;$i++){
            $comment = new Comment();
            $comment->setProduct($this->products[$i%10])
                    ->setDescription("plein de messages trop choux et de messages de haine pure sur le produit ".$i%10);
            $manager->persist($comment);
        }
        $manager->flush();
    }

    /*public function loadCreditCard(ObjectManager $manager){
        for($i=0;$i<10;$i++){
            $creditCard = new CreditCard();
            $creditCard->setUser($this->users[$i])
                       ->setOrders($this->orders[$i])
                       ->setType("visa")
                       ->setExpiration( new DateTime(12/25))
                       ->setOwnerLastName("macias")
                       ->setOwnerFirstName("frederico")
                       ->setNumber(rand(1000000000000000, 9999999999999999));
            $manager->persist($creditCard);
            $creditcards[]=$creditCard;
        }
        $manager->flush();
    }*/

    public function loadPayment(ObjectManager $manager){
        for($i=0;$i<10;$i++){
            $payment = new Payment();
            $payment->setType("creditCard")
                    ->setOrders($this->orders[$i])
                    ->setUser($this->users[$i])
                    /*->addCreditCard($this->creditcards[$i])*/;
            $manager->persist($payment);
        }
        $manager->flush();
    }

   /* public function loadDelivery(ObjectManager $manager){
        for($i=0;$i<10;$i++){
            $delivery = new Delivery();
            $delivery->setUser($this->users[$i])
                     ->setOrder($this->orders[$i])
                     ->setPrice(rand(10, 100))
                     ->setDate(new DateTime('now'))
                     ->setAddress("chez mémé");
            $manager->persist($delivery);
        }
        $manager->flush();
    }*/

    /*public function loadWishlist(ObjectManager $manager){
        for($i=0;$i<10;$i++){
            $wishlist=new Wishlist();
            $wishlist->addProduct($this->products[$i])
                     ->setClient($this->users[$i]);
            $manager->persist($wishlist);
        }
        $manager->flush();
    }*/


}

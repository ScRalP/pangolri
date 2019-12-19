<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="shop_order")
 */

class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="\App\Entity\Cart", mappedBy="order")
     */
    private $cart;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Entity\User", inversedBy="orders")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="\App\Entity\Delivery", mappedBy="order")
     */
    private $delivery;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Entity\Payment", inversedBy="orders")
     */
    private $payment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): self
    {
        $this->cart = $cart;

        // set (or unset) the owning side of the relation if necessary
        $newOrder = null === $cart ? null : $this;
        if ($cart->getOrder() !== $newOrder) {
            $cart->setOrder($newOrder);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDelivery(): ?Delivery
    {
        return $this->delivery;
    }

    public function setDelivery(?Delivery $delivery): self
    {
        $this->delivery = $delivery;

        // set (or unset) the owning side of the relation if necessary
        $newOrder = null === $delivery ? null : $this;
        if ($delivery->getOrder() !== $newOrder) {
            $delivery->setOrder($newOrder);
        }

        return $this;
    }

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function setPayment(?Payment $payment): self
    {
        $this->payment = $payment;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 */
class Cart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductCart", mappedBy="cart")
     */
    private $product_cart;

    /**
     * @ORM\OneToOne(targetEntity="\App\Entity\User", mappedBy="cart")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="\App\Entity\Order", inversedBy="cart")
     */
    private $order;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->product_cart = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        // set (or unset) the owning side of the relation if necessary
        $newCart = null === $user ? null : $this;
        if ($user->getCart() !== $newCart) {
            $user->setCart($newCart);
        }

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return Collection|ProductCart[]
     */
    public function getProductCart(): Collection
    {
        return $this->product_cart;
    }

    public function addProductCart(ProductCart $productCart): self
    {
        if (!$this->product_cart->contains($productCart)) {
            $this->product_cart[] = $productCart;
            $productCart->setCart($this);
        }

        return $this;
    }

    public function removeProductCart(ProductCart $productCart): self
    {
        if ($this->product_cart->contains($productCart)) {
            $this->product_cart->removeElement($productCart);
            // set the owning side to null (unless already changed)
            if ($productCart->getCart() === $this) {
                $productCart->setCart(null);
            }
        }

        return $this;
    }
}

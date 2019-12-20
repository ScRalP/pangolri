<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(max=100, maxMessage="Please don't exceed 100 characters")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @Assert\Positive
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $stock;

    /**
     * @ORM\Column(type="string",length=50, nullable=true)
     */
    private $brand;

    /**
     * @ORM\Column(type="integer")
     */
    private $rate;
    
    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="product")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductCart", mappedBy="product")
     */
    private $product_carts;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Wishlist", inversedBy="products")
     */
    private $wishlists;

    public function __construct()
    {
        $this->images = [];
        $this->categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->product_cart = new ArrayCollection();
        $this->wishlist = new ArrayCollection();
        $this->wishlists = new ArrayCollection();
        $this->product_carts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
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

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(?array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function addImage(string $image){
        $this->images[] = $image;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setProduct($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getProduct() === $this) {
                $comment->setProduct(null);
            }
        }

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * @return Collection|Wishlist[]
     */
    public function getWishlist(): Collection
    {
        return $this->wishlist;
    }

    public function setWishlist(?Wishlist $wishlist): self
    {
        $this->wishlist = $wishlist;

        return $this;
    }

    public function addWishlist(Wishlist $wishlist): self
    {
        if (!$this->wishlists->contains($wishlist)) {
            $this->wishlists[] = $wishlist;
        }

        return $this;
    }

    public function removeWishlist(Wishlist $wishlist): self
    {
        if ($this->wishlists->contains($wishlist)) {
            $this->wishlists->removeElement($wishlist);
        }

        return $this;
    }

    /**
     * @return Collection|Wishlist[]
     */
    public function getWishlists(): Collection
    {
        return $this->wishlists;
    }

    /**
     * @return Collection|ProductCart[]
     */
    public function getProductCarts(): Collection
    {
        return $this->product_carts;
    }

    public function addProductCart(ProductCart $productCart): self
    {
        if (!$this->product_carts->contains($productCart)) {
            $this->product_carts[] = $productCart;
            $productCart->setProduct($this);
        }

        return $this;
    }

    public function removeProductCart(ProductCart $productCart): self
    {
        if ($this->product_carts->contains($productCart)) {
            $this->product_carts->removeElement($productCart);
            // set the owning side to null (unless already changed)
            if ($productCart->getProduct() === $this) {
                $productCart->setProduct(null);
            }
        }

        return $this;
    }
}

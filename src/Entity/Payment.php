<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaymentRepository")
 */
class Payment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Entity\User", inversedBy="payments")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="\App\Entity\Order", mappedBy="payment")
     */
    private $order;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Entity\CreditCard", inversedBy="payments")
     */
    private $credit_card;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->credit_cards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function setOrders(?Order $orders): self
    {
        $this->orders = $orders;

        return $this;
    }

    /**
     * @return Collection|CreditCard[]
     */
    public function getCreditCards(): Collection
    {
        return $this->credit_cards;
    }

    public function addCreditCard(CreditCard $creditCard): self
    {
        if (!$this->credit_cards->contains($creditCard)) {
            $this->credit_cards[] = $creditCard;
            $creditCard->addPayment($this);
        }

        return $this;
    }

    public function removeCreditCard(CreditCard $creditCard): self
    {
        if ($this->credit_cards->contains($creditCard)) {
            $this->credit_cards->removeElement($creditCard);
            $creditCard->removePayment($this);
        }

        return $this;
    }

    public function getCreditCard(): ?CreditCard
    {
        return $this->credit_card;
    }

    public function setCreditCard(?CreditCard $credit_card): self
    {
        $this->credit_card = $credit_card;

        return $this;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setPayment($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getPayment() === $this) {
                $order->setPayment(null);
            }
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

        // set (or unset) the owning side of the relation if necessary
        $newPayment = null === $order ? null : $this;
        if ($order->getPayment() !== $newPayment) {
            $order->setPayment($newPayment);
        }

        return $this;
    }
}

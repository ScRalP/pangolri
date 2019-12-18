<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CreditCardRepository")
 */
class CreditCard
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $owner_first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $owner_last_name;

    /**
     * @ORM\Column(type="date")
     */
    private $expiration;

    /**
     * @ORM\OneToMany(targetEntity="\App\Entity\Payment", mappedBy="credit_card")
     */
    private $payments;

    public function __construct()
    {
        $this->payments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getOwnerFirstName(): ?string
    {
        return $this->owner_first_name;
    }

    public function setOwnerFirstName(string $owner_first_name): self
    {
        $this->owner_first_name = $owner_first_name;

        return $this;
    }

    public function getOwnerLastName(): ?string
    {
        return $this->owner_last_name;
    }

    public function setOwnerLastName(string $owner_last_name): self
    {
        $this->owner_last_name = $owner_last_name;

        return $this;
    }

    public function getExpiration(): ?\DateTimeInterface
    {
        return $this->expiration;
    }

    public function setExpiration(\DateTimeInterface $expiration): self
    {
        $this->expiration = $expiration;

        return $this;
    }

    /**
     * @return Collection|Payment[]
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payment $payment): self
    {
        if (!$this->payments->contains($payment)) {
            $this->payments[] = $payment;
            $payment->setCreditCard($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): self
    {
        if ($this->payments->contains($payment)) {
            $this->payments->removeElement($payment);
            // set the owning side to null (unless already changed)
            if ($payment->getCreditCard() === $this) {
                $payment->setCreditCard(null);
            }
        }

        return $this;
    }
}

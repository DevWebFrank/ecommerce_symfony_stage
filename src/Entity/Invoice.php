<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'invoice', targetEntity: Purchase::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $purchase;

    #[ORM\Column(type: 'boolean')]
    private $is_paid;

    #[ORM\OneToMany(mappedBy: 'invoice', targetEntity: ContentInvoice::class, cascade: ['persist', 'remove'])]
    private $contentInvoice;

    #[ORM\Column(type: 'integer')]
    private $Total;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPurchase(): ?Purchase
    {
        return $this->purchase;
    }

    public function setPurchase(Purchase $purchase): self
    {
        $this->purchase = $purchase;

        return $this;
    }

    public function getIsPaid(): ?bool
    {
        return $this->is_paid;
    }

    public function setIsPaid(bool $is_paid): self
    {
        $this->is_paid = $is_paid;

        return $this;
    }

    public function getContentInvoice(): ?ContentInvoice
    {
        return $this->contentInvoice;
    }

    public function setContentInvoice(ContentInvoice $contentInvoice): self
    {
        // set the owning side of the relation if necessary
        if ($contentInvoice->getInvoice() !== $this) {
            $contentInvoice->setInvoice($this);
        }

        $this->contentInvoice = $contentInvoice;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->Total;
    }

    public function setTotal(int $Total): self
    {
        $this->Total = $Total;

        return $this;
    }
}

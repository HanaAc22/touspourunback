<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AssoAddressEventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssoAddressEventRepository::class)]
#[ApiResource]
class AssoAddressEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $postalCode = null;

    #[ORM\Column(length: 255)]
    private ?string $commune = null;

    #[ORM\OneToOne(mappedBy: 'address', cascade: ['persist', 'remove'])]
    private ?AssoEvents $assoEvents = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getAssoEvents(): ?AssoEvents
    {
        return $this->assoEvents;
    }

    public function setAssoEvents(?AssoEvents $assoEvents): self
    {
        // unset the owning side of the relation if necessary
        if ($assoEvents === null && $this->assoEvents !== null) {
            $this->assoEvents->setAddress(null);
        }

        // set the owning side of the relation if necessary
        if ($assoEvents !== null && $assoEvents->getAddress() !== $this) {
            $assoEvents->setAddress($this);
        }

        $this->assoEvents = $assoEvents;

        return $this;
    }
}

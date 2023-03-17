<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AssoEventsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssoEventsRepository::class)]
#[ApiResource]
class AssoEvents
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $event = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $eventDate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $presential = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    private ?AssoProfile $assoProfile = null;

    #[ORM\OneToOne(inversedBy: 'assoEvents', cascade: ['persist', 'remove'])]
    private ?AssoAddressEvent $address = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?string
    {
        return $this->event;
    }

    public function setEvent(string $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getEventDate(): ?\DateTimeInterface
    {
        return $this->eventDate;
    }

    public function setEventDate(\DateTimeInterface $eventDate): self
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    public function isPresential(): ?bool
    {
        return $this->presential;
    }

    public function setPresential(?bool $presential): self
    {
        $this->presential = $presential;

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

    public function getAssoProfile(): ?AssoProfile
    {
        return $this->assoProfile;
    }

    public function setAssoProfile(?AssoProfile $assoProfile): self
    {
        $this->assoProfile = $assoProfile;

        return $this;
    }

    public function getAddress(): ?AssoAddressEvent
    {
        return $this->address;
    }

    public function setAddress(?AssoAddressEvent $address): self
    {
        $this->address = $address;

        return $this;
    }
}

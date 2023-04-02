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
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'event')]
    private ?AssoAdressEvents $assoAdressEvents = null;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAssoAdressEvents(): ?AssoAdressEvents
    {
        return $this->assoAdressEvents;
    }

    public function setAssoAdressEvents(?AssoAdressEvents $assoAdressEvents): self
    {
        $this->assoAdressEvents = $assoAdressEvents;

        return $this;
    }
}

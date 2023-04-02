<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AssoAdressEventsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssoAdressEventsRepository::class)]
#[ApiResource]
class AssoAdressEvents
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column(length: 255)]
    private ?string $zipCode = null;

    #[ORM\Column(length: 255)]
    private ?string $common = null;

    #[ORM\OneToMany(mappedBy: 'assoAdressEvents', targetEntity: AssoEvents::class)]
    private Collection $event;

    public function __construct()
    {
        $this->event = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCommon(): ?string
    {
        return $this->common;
    }

    public function setCommon(string $common): self
    {
        $this->common = $common;

        return $this;
    }

    /**
     * @return Collection<int, AssoEvents>
     */
    public function getEvent(): Collection
    {
        return $this->event;
    }

    public function addEvent(AssoEvents $event): self
    {
        if (!$this->event->contains($event)) {
            $this->event->add($event);
            $event->setAssoAdressEvents($this);
        }

        return $this;
    }

    public function removeEvent(AssoEvents $event): self
    {
        if ($this->event->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getAssoAdressEvents() === $this) {
                $event->setAssoAdressEvents(null);
            }
        }

        return $this;
    }
}

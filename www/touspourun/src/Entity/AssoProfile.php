<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AssoProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssoProfileRepository::class)]
#[ApiResource]
class AssoProfile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $AssociationName = null;

    #[ORM\Column(length: 255)]
    private ?string $registred = null;

    #[ORM\Column(length: 255)]
    private ?string $siret = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column]
    private ?int $postalCode = null;

    #[ORM\Column(length: 255)]
    private ?string $commune = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\ManyToOne(inversedBy: 'assoRole')]
    private ?Roles $assoRole = null;

    #[ORM\OneToMany(mappedBy: 'assoProfile', targetEntity: AssoEvents::class)]
    private Collection $events;

    #[ORM\OneToMany(mappedBy: 'assoProfile', targetEntity: AssoMembers::class)]
    private Collection $members;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->members = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAssociationName(): ?string
    {
        return $this->AssociationName;
    }

    public function setAssociationName(string $AssociationName): self
    {
        $this->AssociationName = $AssociationName;

        return $this;
    }

    public function getRegistred(): ?string
    {
        return $this->registred;
    }

    public function setRegistred(string $registred): self
    {
        $this->registred = $registred;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
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

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(int $postalCode): self
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getAssoRole(): ?Roles
    {
        return $this->assoRole;
    }

    public function setAssoRole(?Roles $assoRole): self
    {
        $this->assoRole = $assoRole;

        return $this;
    }

    /**
     * @return Collection<int, AssoEvents>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(AssoEvents $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setAssoProfile($this);
        }

        return $this;
    }

    public function removeEvent(AssoEvents $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getAssoProfile() === $this) {
                $event->setAssoProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AssoMembers>
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(AssoMembers $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members->add($member);
            $member->setAssoProfile($this);
        }

        return $this;
    }

    public function removeMember(AssoMembers $member): self
    {
        if ($this->members->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getAssoProfile() === $this) {
                $member->setAssoProfile(null);
            }
        }

        return $this;
    }
}

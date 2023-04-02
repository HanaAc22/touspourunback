<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfilRepository::class)]
class Profil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $userName = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $teatchingLevel = [];

    #[ORM\Column(length: 255)]
    private ?string $siret = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column(length: 255)]
    private ?string $zipCode = null;

    #[ORM\Column(length: 255)]
    private ?string $common = null;

    #[ORM\Column(length: 255)]
    private ?string $assoName = null;

    #[ORM\Column(length: 255)]
    private ?string $registred = null;

    #[ORM\ManyToOne(inversedBy: 'profil')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToOne(mappedBy: 'profil', cascade: ['persist', 'remove'])]
    private ?Status $status = null;

    #[ORM\OneToMany(mappedBy: 'profil', targetEntity: AssoMembers::class, orphanRemoval: true)]
    private Collection $assoMembers;

    public function __construct()
    {
        $this->assoMembers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getTeatchingLevel(): array
    {
        return $this->teatchingLevel;
    }

    public function setTeatchingLevel(array $teatchingLevel): self
    {
        $this->teatchingLevel = $teatchingLevel;

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

    public function getAssoName(): ?string
    {
        return $this->assoName;
    }

    public function setAssoName(string $assoName): self
    {
        $this->assoName = $assoName;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): self
    {
        // set the owning side of the relation if necessary
        if ($status->getProfil() !== $this) {
            $status->setProfil($this);
        }

        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, AssoMembers>
     */
    public function getAssoMembers(): Collection
    {
        return $this->assoMembers;
    }

    public function addAssoMember(AssoMembers $assoMember): self
    {
        if (!$this->assoMembers->contains($assoMember)) {
            $this->assoMembers->add($assoMember);
            $assoMember->setProfil($this);
        }

        return $this;
    }

    public function removeAssoMember(AssoMembers $assoMember): self
    {
        if ($this->assoMembers->removeElement($assoMember)) {
            // set the owning side to null (unless already changed)
            if ($assoMember->getProfil() === $this) {
                $assoMember->setProfil(null);
            }
        }

        return $this;
    }
}

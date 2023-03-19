<?php

namespace App\Entity;

use App\Repository\AssoMembersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssoMembersRepository::class)]
class AssoMembers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $LlastName = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $job = null;

    #[ORM\ManyToOne(inversedBy: 'assoMembers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profil $profil = null;

    #[ORM\OneToOne(mappedBy: 'assoMembers', cascade: ['persist', 'remove'])]
    private ?AssoMembersRole $assoMembersRole = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLlastName(): ?string
    {
        return $this->LlastName;
    }

    public function setLlastName(string $LlastName): self
    {
        $this->LlastName = $LlastName;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getAssoMembersRole(): ?AssoMembersRole
    {
        return $this->assoMembersRole;
    }

    public function setAssoMembersRole(AssoMembersRole $assoMembersRole): self
    {
        // set the owning side of the relation if necessary
        if ($assoMembersRole->getAssoMembers() !== $this) {
            $assoMembersRole->setAssoMembers($this);
        }

        $this->assoMembersRole = $assoMembersRole;

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AssoMembersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssoMembersRepository::class)]
#[ApiResource]
class AssoMembers
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
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $job = null;

    #[ORM\ManyToOne(inversedBy: 'members')]
    private ?AssoProfile $assoProfile = null;

    #[ORM\OneToOne(inversedBy: 'assoMembers', cascade: ['persist', 'remove'])]
    private ?AssoMembersRole $membersRole = null;

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

    public function getAssoProfile(): ?AssoProfile
    {
        return $this->assoProfile;
    }

    public function setAssoProfile(?AssoProfile $assoProfile): self
    {
        $this->assoProfile = $assoProfile;

        return $this;
    }

    public function getMembersRole(): ?AssoMembersRole
    {
        return $this->membersRole;
    }

    public function setMembersRole(?AssoMembersRole $membersRole): self
    {
        $this->membersRole = $membersRole;

        return $this;
    }
}

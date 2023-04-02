<?php

namespace App\Entity;

use App\Repository\AssoMembersRoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssoMembersRoleRepository::class)]
class AssoMembersRole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $assoRoleAdmin = null;

    #[ORM\OneToOne(inversedBy: 'assoMembersRole', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?AssoMembers $assoMembers = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isAssoRoleAdmin(): ?bool
    {
        return $this->assoRoleAdmin;
    }

    public function setAssoRoleAdmin(bool $assoRoleAdmin): self
    {
        $this->assoRoleAdmin = $assoRoleAdmin;

        return $this;
    }

    public function getAssoMembers(): ?AssoMembers
    {
        return $this->assoMembers;
    }

    public function setAssoMembers(AssoMembers $assoMembers): self
    {
        $this->assoMembers = $assoMembers;

        return $this;
    }
}

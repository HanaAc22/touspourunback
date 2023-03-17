<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AssoMembersRoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssoMembersRoleRepository::class)]
#[ApiResource]
class AssoMembersRole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $assoProfileAdmin = null;

    //#[ORM\OneToOne(mappedBy: 'membersRole', cascade: ['persist', 'remove'])]
    #[ORM\Column]
    private ?AssoMembers $assoMembers = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isAssoProfileAdmin(): ?bool
    {
        return $this->assoProfileAdmin;
    }

    public function setAssoProfileAdmin(bool $assoProfileAdmin): self
    {
        $this->assoProfileAdmin = $assoProfileAdmin;

        return $this;
    }

    public function getAssoMembers(): ?AssoMembers
    {
        return $this->assoMembers;
    }

    public function setAssoMembers(?AssoMembers $assoMembers): self
    {
        // unset the owning side of the relation if necessary
        //if ($assoMembers === null && $this->assoMembers !== null) {
        //    $this->assoMembers->setMembersRole(null);
        //}

        // set the owning side of the relation if necessary
        //if ($assoMembers !== null && $assoMembers->getMembersRole() !== $this) {
        //    $assoMembers->setMembersRole($this);
        //}

        $this->assoMembers = $assoMembers;

        return $this;
    }
}

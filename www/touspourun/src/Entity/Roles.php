<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RolesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RolesRepository::class)]
#[ApiResource]
class Roles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $teacher = null;

    #[ORM\Column(nullable: true)]
    private ?bool $parent = null;

    #[ORM\Column(nullable: true)]
    private ?bool $asso = null;

    #[ORM\ManyToOne(inversedBy: 'profileRole')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'parentRole', targetEntity: ParentProfile::class)]
    private Collection $parentProfile;

    #[ORM\OneToMany(mappedBy: 'teacherRole', targetEntity: TeacherProfile::class)]
    private Collection $teacherProfile;

    #[ORM\OneToMany(mappedBy: 'assoRole', targetEntity: AssoProfile::class)]
    private Collection $assoRole;

    public function __construct()
    {
        $this->parentProfile = new ArrayCollection();
        $this->teacherProfile = new ArrayCollection();
        $this->assoRole = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isTeacher(): ?bool
    {
        return $this->teacher;
    }

    public function setTeacher(?bool $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function isParent(): ?bool
    {
        return $this->parent;
    }

    public function setParent(?bool $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function isAsso(): ?bool
    {
        return $this->asso;
    }

    public function setAsso(?bool $asso): self
    {
        $this->asso = $asso;

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

    /**
     * @return Collection<int, ParentProfile>
     */
    public function getParentProfile(): Collection
    {
        return $this->parentProfile;
    }

    public function addParentProfile(ParentProfile $parentProfile): self
    {
        if (!$this->parentProfile->contains($parentProfile)) {
            $this->parentProfile->add($parentProfile);
            $parentProfile->setParentRole($this);
        }

        return $this;
    }

    public function removeParentProfile(ParentProfile $parentProfile): self
    {
        if ($this->parentProfile->removeElement($parentProfile)) {
            // set the owning side to null (unless already changed)
            if ($parentProfile->getParentRole() === $this) {
                $parentProfile->setParentRole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TeacherProfile>
     */
    public function getTeacherProfile(): Collection
    {
        return $this->teacherProfile;
    }

    public function addTeacherProfile(TeacherProfile $teacherProfile): self
    {
        if (!$this->teacherProfile->contains($teacherProfile)) {
            $this->teacherProfile->add($teacherProfile);
            $teacherProfile->setTeacherRole($this);
        }

        return $this;
    }

    public function removeTeacherProfile(TeacherProfile $teacherProfile): self
    {
        if ($this->teacherProfile->removeElement($teacherProfile)) {
            // set the owning side to null (unless already changed)
            if ($teacherProfile->getTeacherRole() === $this) {
                $teacherProfile->setTeacherRole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AssoProfile>
     */
    public function getAssoRole(): Collection
    {
        return $this->assoRole;
    }

    public function addAssoRole(AssoProfile $assoRole): self
    {
        if (!$this->assoRole->contains($assoRole)) {
            $this->assoRole->add($assoRole);
            $assoRole->setAssoRole($this);
        }

        return $this;
    }

    public function removeAssoRole(AssoProfile $assoRole): self
    {
        if ($this->assoRole->removeElement($assoRole)) {
            // set the owning side to null (unless already changed)
            if ($assoRole->getAssoRole() === $this) {
                $assoRole->setAssoRole(null);
            }
        }

        return $this;
    }
}

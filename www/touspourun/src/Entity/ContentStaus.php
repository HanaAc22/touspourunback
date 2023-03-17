<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ContentStausRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContentStausRepository::class)]
#[ApiResource]
class ContentStaus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $published = null;

    #[ORM\Column(nullable: true)]
    private ?bool $draft = null;

    #[ORM\Column(nullable: true)]
    private ?bool $onHold = null;

    #[ORM\OneToOne(mappedBy: 'status', cascade: ['persist', 'remove'])]
    private ?Course $course = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(?bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function isDraft(): ?bool
    {
        return $this->draft;
    }

    public function setDraft(?bool $draft): self
    {
        $this->draft = $draft;

        return $this;
    }

    public function isOnHold(): ?bool
    {
        return $this->onHold;
    }

    public function setOnHold(?bool $onHold): self
    {
        $this->onHold = $onHold;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): self
    {
        // unset the owning side of the relation if necessary
        if ($course === null && $this->course !== null) {
            $this->course->setStatus(null);
        }

        // set the owning side of the relation if necessary
        if ($course !== null && $course->getStatus() !== $this) {
            $course->setStatus($this);
        }

        $this->course = $course;

        return $this;
    }
}

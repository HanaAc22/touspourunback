<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CourseStatusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseStatusRepository::class)]
#[ApiResource]
class CourseStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $published = null;

    #[ORM\OneToOne(inversedBy: 'courseStatus', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Course $course = null;

    #[ORM\Column]
    private ?bool $draft = null;

    #[ORM\Column]
    private ?bool $onHold = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(Course $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function isDraft(): ?bool
    {
        return $this->draft;
    }

    public function setDraft(bool $draft): self
    {
        $this->draft = $draft;

        return $this;
    }

    public function isOnHold(): ?bool
    {
        return $this->onHold;
    }

    public function setOnHold(bool $onHold): self
    {
        $this->onHold = $onHold;

        return $this;
    }
}

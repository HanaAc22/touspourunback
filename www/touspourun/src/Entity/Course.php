<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
#[ApiResource]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\OneToOne(mappedBy: 'course', cascade: ['persist', 'remove'])]
    private ?CourseStatus $courseStatus = null;

    #[ORM\OneToMany(mappedBy: 'course', targetEntity: CourseCategories::class)]
    private Collection $courseCategories;

    #[ORM\OneToMany(mappedBy: 'course', targetEntity: CourseComments::class)]
    private Collection $courseComments;

    public function __construct()
    {
        $this->courseCategories = new ArrayCollection();
        $this->courseComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getCourseStatus(): ?CourseStatus
    {
        return $this->courseStatus;
    }

    public function setCourseStatus(CourseStatus $courseStatus): self
    {
        // set the owning side of the relation if necessary
        if ($courseStatus->getCourse() !== $this) {
            $courseStatus->setCourse($this);
        }

        $this->courseStatus = $courseStatus;

        return $this;
    }

    /**
     * @return Collection<int, CourseCategories>
     */
    public function getCourseCategories(): Collection
    {
        return $this->courseCategories;
    }

    public function addCourseCategory(CourseCategories $courseCategory): self
    {
        if (!$this->courseCategories->contains($courseCategory)) {
            $this->courseCategories->add($courseCategory);
            $courseCategory->setCourse($this);
        }

        return $this;
    }

    public function removeCourseCategory(CourseCategories $courseCategory): self
    {
        if ($this->courseCategories->removeElement($courseCategory)) {
            // set the owning side to null (unless already changed)
            if ($courseCategory->getCourse() === $this) {
                $courseCategory->setCourse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CourseComments>
     */
    public function getCourseComments(): Collection
    {
        return $this->courseComments;
    }

    public function addCourseComment(CourseComments $courseComment): self
    {
        if (!$this->courseComments->contains($courseComment)) {
            $this->courseComments->add($courseComment);
            $courseComment->setCourse($this);
        }

        return $this;
    }

    public function removeCourseComment(CourseComments $courseComment): self
    {
        if ($this->courseComments->removeElement($courseComment)) {
            // set the owning side to null (unless already changed)
            if ($courseComment->getCourse() === $this) {
                $courseComment->setCourse(null);
            }
        }

        return $this;
    }
}

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

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'course', targetEntity: CourseCategoryJoin::class)]
    private Collection $courseJoin;

    public function __construct()
    {
        $this->courseJoin = new ArrayCollection();
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


    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }

    public function getPicture(): string
    {
        return $this->picture;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, CourseCategoryJoin>
     */
    public function getCourseJoin(): Collection
    {
        return $this->courseJoin;
    }

    public function addCourseJoin(CourseCategoryJoin $courseJoin): self
    {
        if (!$this->courseJoin->contains($courseJoin)) {
            $this->courseJoin->add($courseJoin);
            $courseJoin->setCourse($this);
        }

        return $this;
    }

    public function removeCourseJoin(CourseCategoryJoin $courseJoin): self
    {
        if ($this->courseJoin->removeElement($courseJoin)) {
            // set the owning side to null (unless already changed)
            if ($courseJoin->getCourse() === $this) {
                $courseJoin->setCourse(null);
            }
        }

        return $this;
    }

}

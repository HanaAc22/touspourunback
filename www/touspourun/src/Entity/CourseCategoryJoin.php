<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CourseCategoryJoinRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseCategoryJoinRepository::class)]
#[ApiResource]
class CourseCategoryJoin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'courseJoin')]
    private ?Course $course = null;

    #[ORM\ManyToOne(inversedBy: 'categoryJoin')]
    private ?CourseCategory $courseCategory = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function getCourseCategory(): ?CourseCategory
    {
        return $this->courseCategory;
    }

    public function setCourseCategory(?CourseCategory $courseCategory): self
    {
        $this->courseCategory = $courseCategory;

        return $this;
    }
}

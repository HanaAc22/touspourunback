<?php

namespace App\Form\Model;

use ApiPlatform\Metadata\ApiProperty;
use App\Entity\Category;
use App\Entity\Course;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

class ContentFormModel
{
    #[Assert\NotBlank]
    private string $title = '';

    #[Assert\NotBlank]
    private ?string $picture = null;

    #[Assert\NotBlank]
    private string $content = '';

    private DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt;

    /**
     * @var Collection
     */
    private Collection $categories;

    private readonly Category $category;
    private string $name;

    public function __construct(?Course $course = null)
    {
        $this->createdAt = new DateTimeImmutable('now');
        $this->updatedAt = new DateTimeImmutable('now');
        $this->categories = new ArrayCollection();

        if ($course) {
            $this->title = $course->getTitle();
            $this->picture = $course->getPicture();
            $this->content = $course->getContent();
            $this->categories = $course->getCategories();
            $this->updatedAt = new DateTimeImmutable('now');
        }

    }
    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeImmutable $createdAt
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeImmutable|null $updatedAt
     */
    public function setUpdatedAt(?DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category->getName();
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @param Collection $categories
     */
    public function setCategories(Collection $categories): void
    {
        $this->categories = $categories;
    }

    public function getName(): string
    {
        return $this->category->getName();
    }
}
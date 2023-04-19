<?php

namespace App\Form\Model;

use App\Entity\Course;
use App\Entity\CourseCategory;
use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

class ContentFormModel
{
    #[Assert\NotBlank]
    private string $title = 'title';

    #[Assert\NotBlank]
    private ?string $picture = null;

    #[Assert\NotBlank]
    private string $content = 'content';

    private DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt;

    private CourseCategory $category;

    public function __construct(?Course $course = null)
    {
        $this->createdAt = new DateTimeImmutable('now');
        $this->updatedAt = new DateTimeImmutable('now');

        if($course){
            $this->title = $course->getTitle();
            $this->picture = $course->getPicture();
            $this->content = $course->getContent();
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
     * @return CourseCategory
     */
    public function getCategory(): CourseCategory
    {
        return $this->category;
    }

    /**
     * @param CourseCategory $category
     */
    public function setCategory(CourseCategory $category): void
    {
        $this->category = $category;
    }


}
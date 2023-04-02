<?php

namespace App\Form\Model;

use DateTime;
use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;
class ContentFormModel
{
    #[Assert\NotBlank]
    public string $title;

    #[Assert\NotBlank]
    public string $picture;

    #[Assert\NotBlank]
    public string $content;

    public DateTimeImmutable $createdAt;
    public DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable('now');
    }

}
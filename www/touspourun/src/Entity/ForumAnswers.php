<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ForumAnswersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForumAnswersRepository::class)]
#[ApiResource]
class ForumAnswers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $answers = null;

    #[ORM\ManyToOne(inversedBy: 'forumAnswers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ForumQuestions $question = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswers(): ?string
    {
        return $this->answers;
    }

    public function setAnswers(string $answers): self
    {
        $this->answers = $answers;

        return $this;
    }

    public function getQuestion(): ?ForumQuestions
    {
        return $this->question;
    }

    public function setQuestion(?ForumQuestions $question): self
    {
        $this->question = $question;

        return $this;
    }
}

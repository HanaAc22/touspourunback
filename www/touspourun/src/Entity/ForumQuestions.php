<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ForumQuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForumQuestionsRepository::class)]
#[ApiResource]
class ForumQuestions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $questions = null;

    #[ORM\ManyToOne(inversedBy: 'forumQuestions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: ForumAnswers::class)]
    private Collection $forumAnswers;

    public function __construct()
    {
        $this->forumAnswers = new ArrayCollection();
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

    public function getQuestions(): ?string
    {
        return $this->questions;
    }

    public function setQuestions(string $questions): self
    {
        $this->questions = $questions;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, ForumAnswers>
     */
    public function getForumAnswers(): Collection
    {
        return $this->forumAnswers;
    }

    public function addForumAnswer(ForumAnswers $forumAnswer): self
    {
        if (!$this->forumAnswers->contains($forumAnswer)) {
            $this->forumAnswers->add($forumAnswer);
            $forumAnswer->setQuestion($this);
        }

        return $this;
    }

    public function removeForumAnswer(ForumAnswers $forumAnswer): self
    {
        if ($this->forumAnswers->removeElement($forumAnswer)) {
            // set the owning side to null (unless already changed)
            if ($forumAnswer->getQuestion() === $this) {
                $forumAnswer->setQuestion(null);
            }
        }

        return $this;
    }
}

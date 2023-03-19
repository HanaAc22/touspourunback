<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Profil::class)]
    private Collection $profil;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: ForumQuestions::class)]
    private Collection $forumQuestions;

    public function __construct()
    {
        $this->profil = new ArrayCollection();
        $this->forumQuestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Profil>
     */
    public function getProfil(): Collection
    {
        return $this->profil;
    }

    public function addProfil(Profil $profil): self
    {
        if (!$this->profil->contains($profil)) {
            $this->profil->add($profil);
            $profil->setUser($this);
        }

        return $this;
    }

    public function removeProfil(Profil $profil): self
    {
        if ($this->profil->removeElement($profil)) {
            // set the owning side to null (unless already changed)
            if ($profil->getUser() === $this) {
                $profil->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ForumQuestions>
     */
    public function getForumQuestions(): Collection
    {
        return $this->forumQuestions;
    }

    public function addForumQuestion(ForumQuestions $forumQuestion): self
    {
        if (!$this->forumQuestions->contains($forumQuestion)) {
            $this->forumQuestions->add($forumQuestion);
            $forumQuestion->setAuthor($this);
        }

        return $this;
    }

    public function removeForumQuestion(ForumQuestions $forumQuestion): self
    {
        if ($this->forumQuestions->removeElement($forumQuestion)) {
            // set the owning side to null (unless already changed)
            if ($forumQuestion->getAuthor() === $this) {
                $forumQuestion->setAuthor(null);
            }
        }

        return $this;
    }
}

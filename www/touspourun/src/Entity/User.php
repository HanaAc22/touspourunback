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

    #[ORM\Column(length: 180, unique: true, nullable: false)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(nullable: false)]
    private string $password;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ForumQuestions::class)]
    private Collection $forumQuestions;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Roles::class)]
    private Collection $profileRole;

    public function __construct()
    {
        $this->forumQuestions = new ArrayCollection();
        $this->profileRole = new ArrayCollection();
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
            $forumQuestion->setUser($this);
        }

        return $this;
    }

    public function removeForumQuestion(ForumQuestions $forumQuestion): self
    {
        if ($this->forumQuestions->removeElement($forumQuestion)) {
            // set the owning side to null (unless already changed)
            if ($forumQuestion->getUser() === $this) {
                $forumQuestion->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Roles>
     */
    public function getProfileRole(): Collection
    {
        return $this->profileRole;
    }

    public function addProfileRole(Roles $profileRole): self
    {
        if (!$this->profileRole->contains($profileRole)) {
            $this->profileRole->add($profileRole);
            $profileRole->setUser($this);
        }

        return $this;
    }

    public function removeProfileRole(Roles $profileRole): self
    {
        if ($this->profileRole->removeElement($profileRole)) {
            // set the owning side to null (unless already changed)
            if ($profileRole->getUser() === $this) {
                $profileRole->setUser(null);
            }
        }

        return $this;
    }
}

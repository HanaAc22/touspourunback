<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CourseCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseCategoryRepository::class)]
#[ApiResource]
class CourseCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'courseCategory', targetEntity: CourseCategoryJoin::class)]
    private Collection $categoryJoin;

    public function __construct()
    {
        $this->categoryJoin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, CourseCategoryJoin>
     */
    public function getCategoryJoin(): Collection
    {
        return $this->categoryJoin;
    }

    public function addCategoryJoin(CourseCategoryJoin $categoryJoin): self
    {
        if (!$this->categoryJoin->contains($categoryJoin)) {
            $this->categoryJoin->add($categoryJoin);
            $categoryJoin->setCourseCategory($this);
        }

        return $this;
    }

    public function removeCategoryJoin(CourseCategoryJoin $categoryJoin): self
    {
        if ($this->categoryJoin->removeElement($categoryJoin)) {
            // set the owning side to null (unless already changed)
            if ($categoryJoin->getCourseCategory() === $this) {
                $categoryJoin->setCourseCategory(null);
            }
        }

        return $this;
    }
}

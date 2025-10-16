<?php

namespace App\Entity;

use App\Repository\ChapterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChapterRepository::class)]
class Chapter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'chapters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Section $section = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'link')]
    private ?self $linkedBy = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'chapter')]
    private Collection $link;

    public function __construct()
    {
        $this->link = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): static
    {
        $this->section = $section;

        return $this;
    }

    public function getLinkedBy(): ?self
    {
        return $this->linkedBy;
    }

    public function setLinkedBy(?self $linkedBy): static
    {
        $this->linkedBy = $linkedBy;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getLink(): Collection
    {
        return $this->link;
    }

    public function addLink(self $link): static
    {
        if (!$this->link->contains($link)) {
            $this->link->add($link);
            $link->setLinkedBy($this);
        }

        return $this;
    }

    public function removeLink(self $link): static
    {
        if ($this->link->removeElement($link)) {
            // set the owning side to null (unless already changed)
            if ($link->getLinkedBy() === $this) {
                $link->setLinkedBy(null);
            }
        }

        return $this;
    }
}

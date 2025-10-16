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

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'previousChapters')]
    private Collection $followingChapters;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'followingChapters')]
    private Collection $previousChapters;

    public function __construct()
    {
        $this->followingChapters = new ArrayCollection();
        $this->previousChapters = new ArrayCollection();
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

    /**
     * @return Collection<int, self>
     */
    public function getFollowingChapters(): Collection
    {
        return $this->followingChapters;
    }

    public function addFollowingChapter(self $followingChapter): static
    {
        if (!$this->followingChapters->contains($followingChapter)) {
            $this->followingChapters->add($followingChapter);
        }

        return $this;
    }

    public function removeFollowingChapter(self $followingChapter): static
    {
        $this->followingChapters->removeElement($followingChapter);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getPreviousChapters(): Collection
    {
        return $this->previousChapters;
    }

    public function addPreviousChapter(self $previousChapter): static
    {
        if (!$this->previousChapters->contains($previousChapter)) {
            $this->previousChapters->add($previousChapter);
            $previousChapter->addFollowingChapter($this);
        }

        return $this;
    }

    public function removePreviousChapter(self $previousChapter): static
    {
        if ($this->previousChapters->removeElement($previousChapter)) {
            $previousChapter->removeFollowingChapter($this);
        }

        return $this;
    }
}

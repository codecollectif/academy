<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'json')]
    private array $titleJson = [];

    #[ORM\Column]
    private array $contentJson = [];

    #[ORM\ManyToOne(inversedBy: 'pages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleJson(): array
    {
        return $this->titleJson;
    }

    public function setTitleJson(array $titleJson): static
    {
        $this->titleJson = $titleJson;

        return $this;
    }

    public function getContentJson(): array
    {
        return $this->contentJson;
    }

    public function setContentJson(array $contentJson): static
    {
        $this->contentJson = $contentJson;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}

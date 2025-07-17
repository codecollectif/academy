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

    #[ORM\Column]
    private array $titleJson = [];

    #[ORM\Column]
    private array $contentJson = [];

    #[ORM\ManyToOne(inversedBy: 'pages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
}

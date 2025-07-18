<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $titleJson = [];

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
}

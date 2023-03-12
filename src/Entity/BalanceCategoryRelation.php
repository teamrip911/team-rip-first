<?php

namespace App\Entity;

use App\Repository\BalanceCategoryRelationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BalanceCategoryRelationRepository::class)]
class BalanceCategoryRelation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'balanceCategoryRelations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Balance $record = null;

    #[ORM\ManyToOne(inversedBy: 'balanceCategoryRelations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BalanceCategory $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecord(): ?Balance
    {
        return $this->record;
    }

    public function setRecord(?Balance $record): self
    {
        $this->record = $record;

        return $this;
    }

    public function getCategory(): ?BalanceCategory
    {
        return $this->category;
    }

    public function setCategory(?BalanceCategory $category): self
    {
        $this->category = $category;

        return $this;
    }
}

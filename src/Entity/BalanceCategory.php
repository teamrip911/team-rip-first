<?php

namespace App\Entity;

use App\Repository\BalanceCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BalanceCategoryRepository::class)]
#[ORM\Table('balance_categories')]
class BalanceCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: BalanceCategoryRelation::class)]
    private Collection $balanceCategoryRelations;

    public function __construct()
    {
        $this->balanceCategoryRelations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, BalanceCategoryRelation>
     */
    public function getBalanceCategoryRelations(): Collection
    {
        return $this->balanceCategoryRelations;
    }

    public function addBalanceCategoryRelation(BalanceCategoryRelation $balanceCategoryRelation): self
    {
        if (!$this->balanceCategoryRelations->contains($balanceCategoryRelation)) {
            $this->balanceCategoryRelations->add($balanceCategoryRelation);
            $balanceCategoryRelation->setCategory($this);
        }

        return $this;
    }

    public function removeBalanceCategoryRelation(BalanceCategoryRelation $balanceCategoryRelation): self
    {
        if ($this->balanceCategoryRelations->removeElement($balanceCategoryRelation)) {
            // set the owning side to null (unless already changed)
            if ($balanceCategoryRelation->getCategory() === $this) {
                $balanceCategoryRelation->setCategory(null);
            }
        }

        return $this;
    }
}

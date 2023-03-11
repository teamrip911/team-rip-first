<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[ORM\Table('animals')]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: FarmAnimal::class)]
    private Collection $farmAnimals;

    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: AnimalGroup::class)]
    private Collection $animalGroups;

    public function __construct()
    {
        $this->farmAnimals = new ArrayCollection();
        $this->animalGroups = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, FarmAnimal>
     */
    public function getFarmAnimals(): Collection
    {
        return $this->farmAnimals;
    }

    public function addFarmAnimal(FarmAnimal $farmAnimal): self
    {
        if (!$this->farmAnimals->contains($farmAnimal)) {
            $this->farmAnimals->add($farmAnimal);
            $farmAnimal->setAnimal($this);
        }

        return $this;
    }

    public function removeFarmAnimal(FarmAnimal $farmAnimal): self
    {
        if ($this->farmAnimals->removeElement($farmAnimal)) {
            // set the owning side to null (unless already changed)
            if ($farmAnimal->getAnimal() === $this) {
                $farmAnimal->setAnimal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AnimalGroup>
     */
    public function getAnimalGroups(): Collection
    {
        return $this->animalGroups;
    }

    public function addAnimalGroup(AnimalGroup $animalGroup): self
    {
        if (!$this->animalGroups->contains($animalGroup)) {
            $this->animalGroups->add($animalGroup);
            $animalGroup->setAnimal($this);
        }

        return $this;
    }

    public function removeAnimalGroup(AnimalGroup $animalGroup): self
    {
        if ($this->animalGroups->removeElement($animalGroup)) {
            // set the owning side to null (unless already changed)
            if ($animalGroup->getAnimal() === $this) {
                $animalGroup->setAnimal(null);
            }
        }

        return $this;
    }
}

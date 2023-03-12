<?php

namespace App\Entity;

use App\Repository\FarmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: FarmRepository::class)]
#[ORM\Table('farms')]
#[ORM\HasLifecycleCallbacks]
#[Gedmo\SoftDeleteable(fieldName: 'deleted_at', timeAware: false, hardDelete: false)]
class Farm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deleted_at = null;

    #[ORM\OneToMany(mappedBy: 'farm', targetEntity: FarmAnimal::class)]
    private Collection $farmAnimals;

    #[ORM\OneToMany(mappedBy: 'farm', targetEntity: AnimalGroup::class)]
    private Collection $animalGroups;

    #[ORM\OneToMany(mappedBy: 'farm', targetEntity: Balance::class)]
    private Collection $balances;

    public function __construct()
    {
        $this->farmAnimals = new ArrayCollection();
        $this->animalGroups = new ArrayCollection();
        $this->balances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deleted_at;
    }

    public function setDeletedAt(?\DateTimeImmutable $deleted_at): self
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updatedTimestamps(): void
    {
        $this->setUpdatedAt(new \DateTimeImmutable('now'));
        if (null === $this->getCreatedAt()) {
            $this->setCreatedAt(new \DateTimeImmutable('now'));
        }
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
            $farmAnimal->setFarm($this);
        }

        return $this;
    }

    public function removeFarmAnimal(FarmAnimal $farmAnimal): self
    {
        if ($this->farmAnimals->removeElement($farmAnimal)) {
            // set the owning side to null (unless already changed)
            if ($farmAnimal->getFarm() === $this) {
                $farmAnimal->setFarm(null);
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
            $animalGroup->setFarm($this);
        }

        return $this;
    }

    public function removeAnimalGroup(AnimalGroup $animalGroup): self
    {
        if ($this->animalGroups->removeElement($animalGroup)) {
            // set the owning side to null (unless already changed)
            if ($animalGroup->getFarm() === $this) {
                $animalGroup->setFarm(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Balance>
     */
    public function getBalances(): Collection
    {
        return $this->balances;
    }

    public function addBalance(Balance $balance): self
    {
        if (!$this->balances->contains($balance)) {
            $this->balances->add($balance);
            $balance->setFarm($this);
        }

        return $this;
    }

    public function removeBalance(Balance $balance): self
    {
        if ($this->balances->removeElement($balance)) {
            // set the owning side to null (unless already changed)
            if ($balance->getFarm() === $this) {
                $balance->setFarm(null);
            }
        }

        return $this;
    }
}

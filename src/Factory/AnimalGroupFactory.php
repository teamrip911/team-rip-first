<?php

namespace App\Factory;

use App\Entity\Animal;
use App\Entity\AnimalGroup;
use App\Entity\Farm;

class AnimalGroupFactory
{
    public static function create(
        int $count,
        string $description,
        Farm $farm,
        Animal $animal
    ): AnimalGroup {
        $animalGroup = new AnimalGroup();
        $animalGroup->setCount($count);
        $animalGroup->setDescription($description);
        $animalGroup->setFarm($farm);
        $animalGroup->setAnimal($animal);

        return $animalGroup;
    }
}

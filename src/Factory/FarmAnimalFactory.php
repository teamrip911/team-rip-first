<?php

namespace App\Factory;

use App\Entity\Animal;
use App\Entity\Farm;
use App\Entity\FarmAnimal;

class FarmAnimalFactory
{
    public static function create(
        string $nickname,
        string $description,
        \DateTimeInterface $dateOfBirth,
        Farm $farm,
        Animal $animal
    ): FarmAnimal {
        $farmAnimal = new FarmAnimal();
        $farmAnimal->setNickname($nickname);
        $farmAnimal->setDescription($description);
        $farmAnimal->setDateOfBirth($dateOfBirth);
        $farmAnimal->setFarm($farm);
        $farmAnimal->setAnimal($animal);

        return $farmAnimal;
    }
}

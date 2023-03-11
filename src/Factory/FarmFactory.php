<?php

namespace App\Factory;

use App\Entity\Farm;
use App\Entity\User;

class FarmFactory
{
    public static function create(
        string $title,
        string $description,
        string $address,
        User $user
    ): Farm {
        $farm = new Farm();
        $farm->setTitle($title);
        $farm->setDescription($description);
        $farm->setAddress($address);
        $farm->setUser($user);

        return $farm;
    }
}

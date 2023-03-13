<?php

namespace App\Factory;

use App\Entity\Balance;
use App\Entity\BalanceCategory;
use App\Entity\Farm;
use App\Entity\User;

class BalanceFactory
{
    /**
     * @param array<BalanceCategory> $categories
     */
    public static function create(
        \DateTime $recordDate,
        int $amount,
        int $type,
        Farm $farm,
        User $user,
        array $categories
    ): Balance {
        $balance = new Balance();
        $balance->setRecordDate($recordDate);
        $balance->setAmount($amount);
        $balance->setType($type);
        $balance->setFarm($farm);
        $balance->setUser($user);

        foreach ($categories as $category) {
            $balance->addBalanceCategory($category);
        }

        return $balance;
    }
}

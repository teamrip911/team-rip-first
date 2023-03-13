<?php

namespace App\Factory;

use App\Entity\Balance;
use App\Entity\Farm;
use App\Entity\User;

class BalanceFactory
{
    public static function create(
        \DateTime $recordDate,
        int $amount,
        int $type,
        Farm $farm,
        User $user
    ): Balance {
        $balance = new Balance();
        $balance->setRecordDate($recordDate);
        $balance->setAmount($amount);
        $balance->setType($type);
        $balance->setFarm($farm);
        $balance->setUser($user);

        return $balance;
    }
}

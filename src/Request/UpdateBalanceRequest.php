<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints\Type;

class UpdateBalanceRequest extends BaseRequest
{
    #[Type('string')]
    protected string $record_date;

    #[Type('integer')]
    protected int $amount;

    #[Type('integer')]
    protected int $type;

    /**
     * @var array<int>
     */
    #[Type('array')]
    protected array $categories;
}

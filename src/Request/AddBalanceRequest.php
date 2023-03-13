<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class AddBalanceRequest extends BaseRequest
{
    #[NotBlank([])]
    #[Type('string')]
    protected string $record_date;

    #[NotBlank([])]
    #[Type('integer')]
    protected int $amount;

    #[NotBlank([])]
    #[Type('integer')]
    protected int $type;

    /**
     * @var array<int>
     */
    #[NotBlank([])]
    #[Type('array')]
    protected array $categories;

    public function getRecordDate(): string
    {
        return $this->record_date;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return int[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }
}

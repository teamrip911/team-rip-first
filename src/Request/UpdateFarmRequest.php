<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints\Type;

class UpdateFarmRequest extends BaseRequest
{
    #[Type('string')]
    protected string $title;

    #[Type('string')]
    protected string $description;

    #[Type('string')]
    protected string $address;
}

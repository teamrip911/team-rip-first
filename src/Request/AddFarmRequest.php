<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class AddFarmRequest extends BaseRequest
{
    #[NotBlank([])]
    #[Type('string')]
    protected string $title;

    #[NotBlank([])]
    #[Type('string')]
    protected string $description;

    #[NotBlank([])]
    #[Type('string')]
    protected string $address;
}

<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class AddAnimalGroupRequest extends BaseRequest
{
    #[NotBlank([])]
    #[Type('integer')]
    protected int $animal_id;

    #[NotBlank([])]
    #[Type('integer')]
    protected int $farm_id;

    #[NotBlank([])]
    #[Type('integer')]
    protected int $count;

    #[NotBlank([])]
    #[Type('string')]
    protected string $description;
}

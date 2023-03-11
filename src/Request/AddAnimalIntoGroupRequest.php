<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class AddAnimalIntoGroupRequest extends BaseRequest
{
    #[NotBlank([])]
    #[Type('integer')]
    protected int $animal_group_id;

    #[NotBlank([])]
    #[Type('integer')]
    protected int $farm_animal_id;
}

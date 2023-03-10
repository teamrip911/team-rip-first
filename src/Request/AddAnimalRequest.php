<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class AddAnimalRequest extends BaseRequest
{
    #[NotBlank([])]
    #[Type('integer')]
    protected int $animal_id;

    #[NotBlank([])]
    #[Type('string')]
    protected string $nickname;

    #[NotBlank([])]
    #[Type('string')]
    protected string $description;

    #[NotBlank([])]
    #[Type('string')]
    protected string $date_of_birth;
}

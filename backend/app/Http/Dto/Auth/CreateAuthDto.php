<?php

namespace App\Http\Dto\Auth;

use App\Http\Dto\BaseDto;

class CreateAuthDto extends BaseDto
{
    public string $name;
    public string $password_hash;

    public function __construct(array $array)
    {
        parent::__construct($array);
    }
}

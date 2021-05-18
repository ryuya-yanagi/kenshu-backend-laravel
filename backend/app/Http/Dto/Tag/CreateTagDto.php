<?php

namespace App\Http\Dto\Tag;

use App\Http\Dto\BaseDto;

class CreateTagDto extends BaseDto
{
    public string $name;

    public function __construct(array $array)
    {
        parent::__construct($array);
    }
}

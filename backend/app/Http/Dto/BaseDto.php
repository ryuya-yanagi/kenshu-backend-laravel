<?php

namespace App\Http\Dto;

class BaseDto
{
    public function __construct(array $array)
    {
        foreach ($array as $key => $value) {
            $this->$key = $value;
        }
    }
}

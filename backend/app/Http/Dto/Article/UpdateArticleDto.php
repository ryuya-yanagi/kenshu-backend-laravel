<?php

namespace App\Http\Dto\Article;

use App\Http\Dto\BaseDto;

class UpdateArticleDto extends BaseDto
{
    public int $id;
    public string $title;
    public string $body;

    public function __construct(array $array)
    {
        parent::__construct($array);
    }
}

<?php

namespace App\Http\Dto\Article;

use App\Http\Dto\BaseDto;

class CreateArticleDto extends BaseDto
{
    public int $user_id;
    public string $title;
    public string $body;
    public array $tags;
    public array $files;

    public function __construct(array $array)
    {
        parent::__construct($array);
    }
}

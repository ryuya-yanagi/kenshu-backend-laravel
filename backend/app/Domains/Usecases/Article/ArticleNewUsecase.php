<?php

namespace App\Domains\Usecases\Article;

use App\Domains\Repositories\TagRepository;

class ArticleNewUsecase
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function execute()
    {
        return $this->tagRepository->getList();
    }
}

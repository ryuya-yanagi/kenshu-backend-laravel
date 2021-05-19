<?php

namespace App\Usecases\Article;

use App\Domains\Repositories\ArticleRepository;

class ArticleGetListUsecase
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute()
    {
        return $this->articleRepository->getList();
    }
}

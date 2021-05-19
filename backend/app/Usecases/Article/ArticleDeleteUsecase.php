<?php

namespace App\Usecases\Article;

use App\Domains\Repositories\ArticleRepository;

class ArticleDeleteUsecase
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute(int $id)
    {
        return $this->articleRepository->delete($id);
    }
}

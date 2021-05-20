<?php

namespace App\Usecases\Article;

use App\Domains\Repositories\ArticleRepository;
use App\Usecases\Exceptions\NotFoundException;

class ArticleGetDetailUsecase
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute(int $id)
    {
        $article = $this->articleRepository->findById($id);
        if (!$article) {
            throw new NotFoundException();
        }

        return $article;
    }
}

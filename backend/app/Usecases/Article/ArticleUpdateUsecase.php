<?php

namespace App\Usecases\Article;

use App\Domains\Entities\Article;
use App\Domains\Repositories\ArticleRepository;
use App\Http\Dto\Article\UpdateArticleDto;

class ArticleUpdateUsecase
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute(UpdateArticleDto $updateArticleDto): int
    {
        $updateArticle = new Article($updateArticleDto);
        return $this->articleRepository->update($updateArticle);
    }
}

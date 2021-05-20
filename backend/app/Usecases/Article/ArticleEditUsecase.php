<?php

namespace App\Usecases\Article;

use App\Domains\Repositories\ArticleRepository;
use App\Usecases\Exceptions\NotFoundException;
use App\Usecases\Exceptions\PermissionException;

class ArticleEditUsecase
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute(int $user_id, int $article_id)
    {
        $article = $this->articleRepository->findById($article_id);
        if (!$article) {
            throw new NotFoundException();
        }

        if ($user_id !== $article->user_id) {
            throw new PermissionException();
        }

        return $article;
    }
}

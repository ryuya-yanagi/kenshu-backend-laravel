<?php

namespace App\Usecases\Article;

use App\Domains\Entities\Article;
use App\Domains\Repositories\ArticleRepository;
use App\Http\Dto\Article\UpdateArticleDto;
use App\Usecases\Exceptions\NotFoundException;
use App\Usecases\Exceptions\PermissionException;

class ArticleUpdateUsecase
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute(int $user_id,  UpdateArticleDto $uad): int
    {
        $articleEntity = new Article($uad);

        $article = $this->articleRepository->findById($articleEntity->id);
        if (!$article) {
            throw new NotFoundException();
        }

        if ($user_id !== $article->user_id) {
            throw new PermissionException();
        }

        return $this->articleRepository->update($articleEntity);
    }
}

<?php

namespace App\Infrastructure\RepositoryImpl\Eloquent;

use App\Domains\Entities\Article as ArticleEntity;
use App\Domains\Repositories\ArticleRepository;
use App\Infrastructure\DataAccess\Eloquent\Article as ArticleEloquent;

class ArticleRepositoryImpl extends BaseRepositoryImpl implements ArticleRepository
{
    private ArticleEloquent $articleEloquent;

    public function __construct(ArticleEloquent $articleEloquent)
    {
        $this->articleEloquent = $articleEloquent;
    }

    public function getList()
    {
        return $this->articleEloquent->newQuery()->get();
    }

    public function findById(int $articleId): ?array
    {
        $article = $this->articleEloquent->newQuery()->find($articleId);
        if (!$article) {
            return null;
        }

        return $article;
    }

    public function create(ArticleEntity $article): int
    {
        $article = $this->articleEloquent->newQuery()->create([
            'title' => $article->title,
            'body' => $article->body
        ]);

        return (int) $article->toArray()["id"];
    }

    public function update(ArticleEntity $article): int
    {
        $articleId = $this->articleEloquent->newQuery()
            ->whereKey($article->id)
            ->update([
                'title' => $article->title,
                'body' => $article->body
            ]);

        return $articleId;
    }

    public function updateThumbnailId(int $articleId, int $thumbnailId): int
    {
        $articleId = $this->articleEloquent->newQuery()
            ->whereKey($articleId)
            ->update([
                'thumbnail_id' => $thumbnailId
            ]);

        return $articleId;
    }

    public function delete(int $articleId): int
    {
        $articleId = $this->articleEloquent->newQuery()
            ->whereKey($articleId)
            ->delete();

        return $articleId;
    }
}

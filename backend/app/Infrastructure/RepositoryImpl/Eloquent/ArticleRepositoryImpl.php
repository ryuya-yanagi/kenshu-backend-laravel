<?php

namespace App\Infrastructure\RepositoryImpl\Eloquent;

use App\Domains\Entities\Article as ArticleEntity;
use App\Domains\Repositories\ArticleRepository;
use App\Infrastructure\DataAccess\Eloquent\Article as ArticleEloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleArticleEntity;

class ArticleRepositoryImpl extends BaseRepositoryImpl implements ArticleRepository
{
    use ConvertibleArticleEntity;

    private ArticleEloquent $articleEloquent;

    public function __construct(ArticleEloquent $articleEloquent)
    {
        $this->articleEloquent = $articleEloquent;
    }

    public function getList(): array
    {
        $builder = $this->articleEloquent->newQuery();
        $builder->with('user');
        $result = $builder->get()->toArray();

        return $this->toArticleEntityCollection($result);
    }

    public function findById(int $articleId): ?ArticleEntity
    {
        $builder = $this->articleEloquent->newQuery();
        $builder->with('user');
        $result = $builder->find($articleId)->toArray();

        if (!$result) {
            return null;
        }

        return $this->toArticleEntity($result);
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

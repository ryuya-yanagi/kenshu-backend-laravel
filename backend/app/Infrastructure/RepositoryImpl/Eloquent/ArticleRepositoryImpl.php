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
        $builder->with('thumbnail');
        $result = $builder->orderBy('created_at', 'DESC')->get()->toArray();

        return $this->toArticleEntityCollection($result);
    }

    public function findById(int $article_id): ?ArticleEntity
    {
        $builder = $this->articleEloquent->newQuery();
        $builder->with('user');
        $builder->with('photos');
        $builder->with('tags');
        $result = $builder->find($article_id);

        if (!$result) {
            return null;
        }

        return $this->toArticleEntity($result->toArray());
    }

    public function create(ArticleEntity $article): ArticleEntity
    {
        $article = $this->articleEloquent->newQuery()->create([
            'user_id' => $article->user_id,
            'title' => $article->title,
            'body' => $article->body
        ]);

        return $this->toArticleEntity($article->toArray());
    }

    public function update(ArticleEntity $article): int
    {
        $result = $this->articleEloquent->newQuery()
            ->whereKey($article->id)
            ->update([
                'title' => $article->title,
                'body' => $article->body
            ]);

        return $result;
    }

    public function updatethumbnailId(int $article_id, int $thumbnail_id): int
    {
        $result = $this->articleEloquent->newQuery()
            ->whereKey($article_id)
            ->update([
                'thumbnail_id' => $thumbnail_id
            ]);

        return $result;
    }

    public function attachTag(int $article_id, int $tag_id)
    {
        $article = $this->articleEloquent->newQuery()
            ->find($article_id);
        $article->tags()->attach($tag_id);
    }

    public function delete(int $article_id): int
    {
        $result = $this->articleEloquent->newQuery()
            ->whereKey($article_id)
            ->delete();

        return $result;
    }
}

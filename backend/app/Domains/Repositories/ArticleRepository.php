<?php

namespace App\Domains\Repositories;

use App\Domains\Entities\Article;

interface ArticleRepository extends BaseRepository
{
    public function getList(): array;
    public function findById(int $id): ?Article;
    public function create(Article $article): Article;
    public function update(Article $article): int;
    public function updateThumbnailId(int $article_id, int $thumbnail_id): int;
    public function attachTag(int $article_id, int $tag_id);
    public function delete(int $id): int;
}

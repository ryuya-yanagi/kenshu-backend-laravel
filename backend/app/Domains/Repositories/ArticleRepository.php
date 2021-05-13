<?php

namespace App\Domains\Repositories;

use App\Domains\Entities\Article;

interface ArticleRepository extends BaseRepository
{
    public function getList();
    public function findById(int $id): ?array;
    public function create(Article $article): int;
    public function update(Article $article): int;
    public function updateThumbnailId(int $id, int $thumbnail_id): int;
    public function delete(int $id): int;
}

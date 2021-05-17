<?php

namespace App\Domains\Repositories;

use App\Domains\Entities\Tag;

interface TagRepository extends BaseRepository
{
    public function getList(): array;
    public function findById(int $id): ?Tag;
    public function create(Tag $tag): Tag;
}

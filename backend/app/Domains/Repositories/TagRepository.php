<?php

namespace App\Domains\Repositories;

interface TagRepository extends BaseRepository
{
    public function getList(): array;
    public function findById(int $id): ?array;
    public function findByName(string $name): ?object;
    public function create(Tag $tag): int;
    public function update(Tag $tag): int;
}

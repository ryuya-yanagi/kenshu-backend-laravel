<?php

namespace App\Domains\Repositories;

use App\Domains\Entities\User;

interface UserRepository extends BaseRepository
{
    public function getList(): array;
    public function findById(int $id): ?User;
}

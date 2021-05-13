<?php

namespace App\Domains\Repositories;

use App\Domains\Entities\Auth;

interface AuthRepository extends BaseRepository
{
    public function findUserByName(string $name): ?object;
    public function create(Auth $auth): int;
}

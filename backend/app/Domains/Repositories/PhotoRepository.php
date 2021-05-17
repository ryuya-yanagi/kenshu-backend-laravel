<?php

namespace App\Domains\Repositories;

use App\Domains\Entities\Photo;

interface PhotoRepository extends BaseRepository
{
    public function create(Photo $photo): Photo;
    public function createValues(array $array): ?int;
}

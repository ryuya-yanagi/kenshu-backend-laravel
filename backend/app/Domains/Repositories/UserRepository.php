<?php

namespace App\Domains\Repositories;

interface UserRepository extends BaseRepository
{
    public function getList();
    public function findById(int $id);
}

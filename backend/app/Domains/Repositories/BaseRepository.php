<?php

namespace App\Domains\Repositories;

interface BaseRepository
{
    public function beginTransaction();
    public function commit();
    public function rollBack();
}

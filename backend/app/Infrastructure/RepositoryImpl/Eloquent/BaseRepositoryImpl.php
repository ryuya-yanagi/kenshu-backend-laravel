<?php

namespace App\Infrastructure\RepositoryImpl\Eloquent;

use App\Domains\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class BaseRepositoryImpl implements BaseRepository
{
    public function beginTransaction()
    {
        DB::beginTransaction();
    }

    public function commit()
    {
        DB::commit();
    }

    public function rollBack()
    {
        DB::rollBack();
    }
}

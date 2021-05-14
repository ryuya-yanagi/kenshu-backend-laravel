<?php

namespace App\Infrastructure\DataAccess\Eloquent;

class Article extends BaseEloquent
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

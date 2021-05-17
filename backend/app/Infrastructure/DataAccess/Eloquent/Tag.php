<?php

namespace App\Infrastructure\DataAccess\Eloquent;

class Tag extends BaseEloquent
{
    protected $fillable = [
        'name',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'articles_tags');
    }
}

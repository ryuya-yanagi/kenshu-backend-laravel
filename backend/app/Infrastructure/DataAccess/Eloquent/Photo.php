<?php

namespace App\Infrastructure\DataAccess\Eloquent;

class Photo extends BaseEloquent
{
    protected $fillable = ['article_id', 'url'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

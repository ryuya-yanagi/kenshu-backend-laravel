<?php

namespace App\Infrastructure\DataAccess\Eloquent;

class Tag extends BaseEloquent
{
    protected $fillable = [
        'name',
    ];

    protected $hidden = array('pivot');

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'articles_tags');
    }
}

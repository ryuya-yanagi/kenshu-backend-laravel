<?php

namespace App\Infrastructure\DataAccess\Eloquent;

class Article extends BaseEloquent
{
    protected $fillable = [
        'title', 'body', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function thumbnail()
    {
        return $this->hasOne(Photo::class, 'id', 'thumbnail_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'articles_tags');
    }
}

<?php

namespace App\Infrastructure\DataAccess\Eloquent;

use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends BaseEloquent
{
    protected $guarded = [
        'password_hash',
    ];

    protected $hidden = [
        'password_hash',
    ];

    /**
     * ユーザーの投稿した記事を取得
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class)->orderBy('created_at', 'DESC');
    }
}

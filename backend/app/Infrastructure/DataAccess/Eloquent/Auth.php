<?php

namespace App\Infrastructure\DataAccess\Eloquent;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Auth extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'password_hash',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    protected $table = 'users';
}

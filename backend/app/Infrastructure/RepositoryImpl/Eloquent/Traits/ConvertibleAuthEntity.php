<?php

namespace App\Infrastructure\RepositoryImpl\Eloquent\Traits;

use App\Domains\Entities\Auth;

trait ConvertibleAuthEntity
{
    /**
     * @param array $from
     * 
     * @return Auth
     */
    protected function toAuthEntity(array $from): Auth
    {
        return new Auth((object) $from);
    }
}

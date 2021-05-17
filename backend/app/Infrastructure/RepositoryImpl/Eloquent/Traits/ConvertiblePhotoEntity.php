<?php

namespace App\Infrastructure\RepositoryImpl\Eloquent\Traits;

use App\Domains\Entities\Photo;

trait ConvertiblePhotoEntity
{
    /**
     * @param array $from
     * 
     * @return Photo
     */
    protected function toPhotoEntity(array $from): Photo
    {
        return new Photo((object) $from);
    }
}

<?php

namespace App\Infrastructure\RepositoryImpl\Eloquent\Traits;

use App\Domains\Entities\Tag;

trait ConvertibleTagEntity
{
    /**
     * @param array $from
     * 
     * @return Tag
     */
    protected function toTagEntity(array $from): Tag
    {
        return new Tag((object) $from);
    }

    protected function toTagEntityCollection(array $array)
    {
        $tags = array_map(function ($record) {
            return new Tag((object) $record);
        }, $array);

        return $tags;
    }
}

<?php

namespace App\Infrastructure\RepositoryImpl\Eloquent\Traits;

use App\Domains\Entities\Article;

trait ConvertibleArticleEntity
{
    /**
     * @param array $from
     *
     * @return Article
     */
    protected function toArticleEntity(array $from): Article
    {
        return new Article((object) $from);
    }

    protected function toArticleEntityCollection(array $array): array
    {
        $articles = array_map(function ($record) {
            return new Article((object) $record);
        }, $array);

        return $articles;
    }
}

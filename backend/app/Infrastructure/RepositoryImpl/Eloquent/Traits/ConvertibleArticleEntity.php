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
        $articles = [];
        foreach ($array as $record) {
            array_push($articles, new Article((object) $record));
        }

        return $articles;
    }
}

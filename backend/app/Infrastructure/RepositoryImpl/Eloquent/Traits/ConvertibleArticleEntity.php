<?php

namespace App\Infrastructure\RepositoryImpl\Eloquent\Traits;

use App\Domains\Entities\Article as ArticleEntity;

trait ConvertibleArticleEntity
{
    /**
     * @param array $from
     *
     * @return Article
     */
    protected function toArticleEntity(array $from): ArticleEntity
    {
        return new ArticleEntity((object) $from);
    }

    protected function toArticleEntityCollection(array $array): array
    {
        $articles = [];
        foreach ($array as $record) {
            array_push($articles, new ArticleEntity((object) $record));
        }

        return $articles;
    }
}

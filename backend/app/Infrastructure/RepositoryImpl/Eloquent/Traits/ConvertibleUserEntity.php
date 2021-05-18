<?php

namespace App\Infrastructure\RepositoryImpl\Eloquent\Traits;

use App\Domains\Entities\User as UserEntity;

trait ConvertibleUserEntity
{
    use ConvertibleArticleEntity;

    /**
     * @param array $from
     *
     * @return UserEntity
     */
    protected function toUserEntity(array $from): UserEntity
    {
        $userEntity = new UserEntity((object) $from);

        if (!isset($from["articles"])) {
            return $userEntity;
        }

        $articles = [];
        foreach ($from["articles"] as $article) {
            array_push($articles, $this->toArticleEntity($article));
        }
        $userEntity->setArticles($articles);

        return $userEntity;
    }

    protected function toUserEntityCollection(array $array): array
    {
        $users = array_map(function ($record) {
            return new UserEntity((object) $record);
        }, $array);

        return $users;
    }
}

<?php

namespace App\Infrastructure\RepositoryImpl\Eloquent;

use App\Domains\Entities\Photo as PhotoEntity;
use App\Domains\Repositories\PhotoRepository;
use App\Infrastructure\DataAccess\Eloquent\Photo as PhotoEloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertiblePhotoEntity;

class PhotoRepositoryImpl extends BaseRepositoryImpl implements PhotoRepository
{
    use ConvertiblePhotoEntity;

    private PhotoEloquent $photoEloquent;

    public function __construct(PhotoEloquent $photoEloquent)
    {
        $this->photoEloquent = $photoEloquent;
    }

    public function create(PhotoEntity $photo): PhotoEntity
    {
        $photo = $this->photoEloquent->newQuery()->create([
            'article_id' => $photo->article_id,
            'url' => $photo->url,
        ]);

        return $this->toPhotoEntity($photo->toArray());
    }

    /**
     * @param PhotoEntity[]
     * 
     * @return int
     */
    public function createValues(array $array): ?int
    {
        $firstInsertId = null;
        foreach ($array as $index => $photo) {
            $createPhoto =  $this->create($photo);
            if ($index === 0) $firstInsertId = $createPhoto->id;
        }
        return $firstInsertId;
    }
}

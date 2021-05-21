<?php

namespace App\Infrastructure\RepositoryImpl\Eloquent;

use App\Domains\Entities\Tag as TagEntity;
use App\Domains\Repositories\TagRepository;
use App\Infrastructure\DataAccess\Eloquent\Tag as TagEloquent;
use App\Infrastructure\RepositoryImpl\Eloquent\Traits\ConvertibleTagEntity;

class TagRepositoryImpl extends BaseRepositoryImpl implements TagRepository
{
    use ConvertibleTagEntity;

    private TagEloquent $tagEloquent;

    public function __construct(TagEloquent $tagEloquent)
    {
        $this->tagEloquent = $tagEloquent;
    }

    public function getList(): array
    {
        $result = $this->tagEloquent->newQuery()->get()->toArray();

        return $this->toTagEntityCollection($result);
    }

    public function findById(int $id): ?TagEntity
    {
        $builder = $this->tagEloquent->newQuery();
        $builder->with('articles.thumbnail')->with('articles.user');
        $result = $builder->find($id);

        if (!$result) {
            return null;
        }

        return $this->toTagEntity($result->toArray());
    }

    public function create(TagEntity $tag): TagEntity
    {
        $tag = $this->tagEloquent->newQuery()->create([
            'name' => $tag->name,
        ]);

        return $this->toTagEntity($tag->toArray());
    }
}

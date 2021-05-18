<?php

namespace App\Domains\Usecases\Tag;

use App\Domains\Entities\Tag;
use App\Domains\Repositories\TagRepository;

class TagGetDetailUsecase
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function execute(int $id): ?Tag
    {
        return $this->tagRepository->findById($id);
    }
}

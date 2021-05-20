<?php

namespace App\Usecases\Tag;

use App\Domains\Entities\Tag;
use App\Domains\Repositories\TagRepository;
use App\Usecases\Exceptions\NotFoundException;

class TagGetDetailUsecase
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function execute(int $id): Tag
    {
        $tag = $this->tagRepository->findById($id);
        if (!$tag) {
            throw new NotFoundException();
        }

        return $tag;
    }
}

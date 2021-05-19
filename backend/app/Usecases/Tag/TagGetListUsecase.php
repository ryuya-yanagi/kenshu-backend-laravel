<?php

namespace App\Usecases\Tag;

use App\Domains\Repositories\TagRepository;

class TagGetListUsecase
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function execute()
    {
        return $this->tagRepository->getList();
    }
}

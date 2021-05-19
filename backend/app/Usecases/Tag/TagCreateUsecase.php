<?php

namespace App\Usecases\Tag;

use App\Domains\Entities\Tag;
use App\Domains\Repositories\TagRepository;
use App\Http\Dto\Tag\CreateTagDto;

class TagCreateUsecase
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function execute(CreateTagDto $createTagDto)
    {
        $createTag = new Tag($createTagDto);

        $result = $this->tagRepository->create($createTag);
        return $result->id;
    }
}

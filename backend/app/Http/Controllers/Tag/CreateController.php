<?php

namespace App\Http\Controllers\Tag;

use App\Domains\Usecases\Tag\TagCreateUsecase;
use App\Http\Controllers\Controller;
use App\Http\Dto\Tag\CreateTagDto;
use App\Http\Requests\Tag\CreateTagRequest;

class CreateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param TagCreateUsecase
     * 
     * @return Response
     */
    public function __invoke(CreateTagRequest $request, TagCreateUsecase $usecase)
    {
        $createTagDto = new CreateTagDto([
            'name' => $request->name,
        ]);
        $tagId = $usecase->execute($createTagDto);

        return redirect(route('tags.id', [
            'id' => $tagId
        ]));
    }
}

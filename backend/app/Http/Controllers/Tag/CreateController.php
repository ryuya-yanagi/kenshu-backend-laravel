<?php

namespace App\Http\Controllers\Tag;

use App\Usecases\Tag\TagCreateUsecase;
use App\Http\Controllers\Controller;
use App\Http\Dto\Tag\CreateTagDto;
use App\Http\Requests\Tag\CreateRequest;

class CreateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param CreateRequest
     * @param TagCreateUsecase
     * 
     * @return Response
     */
    public function __invoke(CreateRequest $request, TagCreateUsecase $usecase)
    {
        $createTagDto = new CreateTagDto([
            'name' => $request->name,
        ]);
        $tagId = $usecase->execute($createTagDto);

        return redirect(route('tags.show', [
            'id' => $tagId
        ]));
    }
}

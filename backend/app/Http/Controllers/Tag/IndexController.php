<?php

namespace App\Http\Controllers\Tag;

use App\Usecases\Tag\TagGetListUsecase;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * @param TagGetListUsecase
     * 
     * @return Response
     */
    public function __invoke(TagGetListUsecase $usecase)
    {
        $tags = $usecase->execute();

        return view('tags.index', ['tags' => $tags]);
    }
}

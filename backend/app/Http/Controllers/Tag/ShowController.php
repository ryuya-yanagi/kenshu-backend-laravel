<?php

namespace App\Http\Controllers\Tag;

use App\Usecases\Tag\TagGetDetailUsecase;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    /**
     * 数字に変換できない文字列の排除のためのMiddlewareを登録
     */
    public function __construct()
    {
        $this->middleware('is_numeric($id)');
    }

    /**
     * @param string $id
     * @param TagGetDetailUsecase 
     * 
     * @return Response
     */
    public function __invoke(string $id, TagGetDetailUsecase $usecase)
    {
        $tag = $usecase->execute((int) $id);

        return view('tags.id', ['tag' => $tag]);
    }
}

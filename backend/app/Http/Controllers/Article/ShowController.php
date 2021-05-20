<?php

namespace App\Http\Controllers\Article;

use App\Usecases\Article\ArticleGetDetailUsecase;
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
     * @param ArticleGetListUsecase
     * 
     * @return Response
     */
    public function __invoke(string $id, ArticleGetDetailUsecase $usecase)
    {
        $article = $usecase->execute((int) $id);

        return view('articles.id', ['article' => $article]);
    }
}

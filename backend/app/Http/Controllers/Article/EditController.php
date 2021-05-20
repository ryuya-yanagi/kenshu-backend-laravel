<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Usecases\Article\ArticleEditUsecase;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{
    /**
     * 数字に変換できない文字列の排除のためのMiddlewareを登録
     */
    public function __construct()
    {
        $this->middleware('is_numeric($id)');
    }

    /**
     * @param string
     * @param ArticleEditUsecase
     * 
     * @return Response
     */
    public function __invoke(string $id, ArticleEditUsecase $usecase)
    {
        $article = $usecase->execute((int) Auth::id(), (int) $id);

        return view('articles.edit', ['article' => $article]);
    }
}

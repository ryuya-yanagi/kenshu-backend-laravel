<?php

namespace App\Http\Controllers\Article;

use App\Usecases\Article\ArticleDeleteUsecase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
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
     * @param ArticleUpdateUsecase
     * 
     * @return Response
     */
    public function __invoke(string $id, ArticleDeleteUsecase $usecase)
    {
        $usecase->execute((int) Auth::id(), (int) $id);

        return redirect('/mypage');
    }
}

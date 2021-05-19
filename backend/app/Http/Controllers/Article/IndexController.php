<?php

namespace App\Http\Controllers\Article;

use App\Usecases\Article\ArticleGetListUsecase;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * @param ArticleGetListUsecase
     */
    public function __invoke(ArticleGetListUsecase $usecase)
    {
        $articles = $usecase->execute();

        return view('articles.index', ['articles' => $articles]);
    }
}

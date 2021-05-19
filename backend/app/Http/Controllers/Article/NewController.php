<?php

namespace App\Http\Controllers\Article;

use App\Usecases\Article\ArticleNewUsecase;
use App\Http\Controllers\Controller;

class NewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param ArticleNewUsecase
     */
    public function __invoke(ArticleNewUsecase $usecase)
    {
        $tags = $usecase->execute();

        return view('articles.new', ['tags' => $tags]);
    }
}

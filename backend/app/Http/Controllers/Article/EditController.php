<?php

namespace App\Http\Controllers\Article;

use App\Domains\Usecases\Article\ArticleGetDetailUsecase;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function __construct()
    {
        $this->middleware(['check.permissions']);
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
        if (!$article) {
            abort(404);
        }

        return view('articles.edit', ['article' => $article]);
    }
}

<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Usecases\Article\ArticleEditUsecase;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{
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

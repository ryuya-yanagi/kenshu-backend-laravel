<?php

namespace App\Http\Controllers\Article;

use App\Usecases\Article\ArticleDeleteUsecase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
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

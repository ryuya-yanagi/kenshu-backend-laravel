<?php

namespace App\Http\Controllers\Article;

use App\Usecases\Article\ArticleDeleteUsecase;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['check.permissions']);
    }

    /**
     * @param ArticleUpdateUsecase
     * 
     * @return Response
     */
    public function __invoke(string $id, ArticleDeleteUsecase $usecase)
    {
        $result = $usecase->execute((int) $id);

        if ($result === 0) {
            abort(404);
        }

        return redirect('/mypage');
    }
}

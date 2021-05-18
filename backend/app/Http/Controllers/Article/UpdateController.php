<?php

namespace App\Http\Controllers\Article;

use App\Domains\Usecases\Article\ArticleUpdateUsecase;
use App\Http\Controllers\Controller;
use App\Http\Dto\Article\UpdateArticleDto;
use App\Http\Requests\Article\UpdateArticleRequest;

class UpdateController extends Controller
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
    public function __invoke(string $id, UpdateArticleRequest $request, ArticleUpdateUsecase $usecase)
    {
        $updateArticleDto = new UpdateArticleDto([
            'id' => (int) $id,
            'title' => $request->title,
            'body' => $request->body,
        ]);
        $result = $usecase->execute($updateArticleDto);

        if ($result === 0) {
            abort(404);
        }

        return redirect(route('articles.id', [
            'id' => $id
        ]));
    }
}

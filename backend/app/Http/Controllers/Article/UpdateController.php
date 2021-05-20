<?php

namespace App\Http\Controllers\Article;

use App\Usecases\Article\ArticleUpdateUsecase;
use App\Http\Controllers\Controller;
use App\Http\Dto\Article\UpdateArticleDto;
use App\Http\Requests\Article\UpdateRequest;

class UpdateController extends Controller
{
    /**
     * @param UpdateRequest
     * @param ArticleUpdateUsecase
     * 
     * @return Response
     */
    public function __invoke(string $id, UpdateRequest $request, ArticleUpdateUsecase $usecase)
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

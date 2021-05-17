<?php

namespace App\Http\Controllers\Article;

use App\Domains\Usecases\Article\ArticleCreateUsecase;
use App\Http\Controllers\Controller;
use App\Http\Dto\Article\CreateArticleDto;
use App\Http\Requests\Article\CreateArticleRequest;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    /**
     * @param ArticleCreateUsecase
     */
    public function __invoke(CreateArticleRequest $request, ArticleCreateUsecase $usecase)
    {
        $createArticleDto = new CreateArticleDto([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body,
            'files' => $request->file('files'),
        ]);
        $createArticleId = $usecase->execute($createArticleDto);

        return redirect(route('articles.id', [
            'id' => $createArticleId
        ]));
    }
}

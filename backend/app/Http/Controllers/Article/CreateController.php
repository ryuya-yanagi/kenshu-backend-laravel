<?php

namespace App\Http\Controllers\Article;

use App\Usecases\Article\ArticleCreateUsecase;
use App\Http\Controllers\Controller;
use App\Http\Dto\Article\CreateArticleDto;
use App\Http\Requests\Article\CreateRequest;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    /**
     * @param ArticleCreateUsecase
     * 
     * @return Response
     */
    public function __invoke(CreateRequest $request, ArticleCreateUsecase $usecase)
    {
        $createArticleDto = new CreateArticleDto([
            'user_id' => (int) Auth::id(),
            'title' => $request->title,
            'body' => $request->body,
            'tags' => $request->tags ?? [],
            'files' => $request->file('files') ?? [],
        ]);

        $createArticleId = $usecase->execute($createArticleDto);

        return redirect(route('articles.show', [
            'id' => $createArticleId
        ]));
    }
}

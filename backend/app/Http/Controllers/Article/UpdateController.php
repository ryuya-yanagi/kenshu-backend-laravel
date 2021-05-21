<?php

namespace App\Http\Controllers\Article;

use App\Usecases\Article\ArticleUpdateUsecase;
use App\Http\Controllers\Controller;
use App\Http\Dto\Article\UpdateArticleDto;
use App\Http\Requests\Article\UpdateRequest;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    /**
     * 数字に変換できない文字列の排除のためのMiddlewareを登録
     */
    public function __construct()
    {
        $this->middleware('is_numeric($id)');
    }

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

        $usecase->execute((int) Auth::id(), $updateArticleDto);

        return redirect(route('articles.show', [
            'id' => $id
        ]));
    }
}

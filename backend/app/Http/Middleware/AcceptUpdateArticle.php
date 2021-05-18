<?php

namespace App\Http\Middleware;

use App\Infrastructure\DataAccess\Eloquent\Article;
use Illuminate\Support\Facades\Auth;
use Closure;

class AcceptUpdateArticle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->route('id');
        if (!is_numeric($id)) {
            abort(404);
        }

        $article = Article::find($id);
        if (!$article) {
            abort(404);
        }

        if ($article->user_id !== Auth::id()) {
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}

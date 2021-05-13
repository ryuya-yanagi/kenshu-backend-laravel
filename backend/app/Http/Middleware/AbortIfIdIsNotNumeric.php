<?php

namespace App\Http\Middleware;

use Closure;

class AbortIfIdIsNotNumeric
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
        if (!is_numeric($request->route('id'))) {
            abort(404);
        }
        return $next($request);
    }
}

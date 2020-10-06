<?php

namespace App\Http\Middleware;

use Closure;

class OwnPackageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $parameter)
    {
        if ($request->route()->parameter($parameter)->user_id == $request->user()->id) {
            return $next($request);
        }
        else {
            abort(403, 'Access denied');
        }
    }
}

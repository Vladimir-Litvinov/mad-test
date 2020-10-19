<?php

namespace App\Http\Middleware;

use Closure;

class OwnAppointmentMiddleware
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
        if ($request->route()->parameter($parameter)->client_id == $request->user()->id) {
            return $next($request);
        } else {
            abort(403, 'Access denied');
        }
    }
}

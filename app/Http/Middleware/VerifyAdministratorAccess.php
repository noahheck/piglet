<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAdministratorAccess
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
        if (!\Auth::user()->is_admin) {
            abort(403, "You failed the `is_admin` check");
        }

        return $next($request);
    }
}

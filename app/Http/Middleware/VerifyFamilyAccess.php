<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class VerifyFamilyAccess
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
        $user   = Auth::user();

        $family = $request->route('family');

        if ($family && !$family->isAccessibleBy($user)) {
            throw new AccessDeniedHttpException("You don't have access to this family");
        }

        return $next($request);
    }
}

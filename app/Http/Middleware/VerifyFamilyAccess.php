<?php

namespace App\Http\Middleware;

use App\Family;
use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        $family = $request->route('family');

        if ($family) {
            if (!($family instanceof Family)) {
                $family = Family::find($family);
            }

            /**
             * Note the addition of the ! in the first instance
             */
            if (!$family) {
                throw new AccessDeniedHttpException("You don't have access to this family!");
            }

            if (!$family->isAccessibleBy(Auth::user())) {
                throw new AccessDeniedHttpException("You don't have access to this family");
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Family;
use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class VerifyEmailVerification
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
        $user = Auth::user();

        if ($user && $user->id && !$user->email_verified) {
            return response()->redirectToRoute('user-settings.show-verify-email');
        }


        return $next($request);
    }
}

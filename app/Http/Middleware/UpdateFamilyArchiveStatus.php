<?php

namespace App\Http\Middleware;

use App\Family;
use Closure;

class UpdateFamilyArchiveStatus
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

            $family->archive = true;

            $family->save();
        }

        return $next($request);
    }
}

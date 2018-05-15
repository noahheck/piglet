<?php

namespace App\Http\Middleware;

use App\Service\FamilyConnectService;
use Closure;

class ConnectFamilyDatabase
{
    /**
     * @var FamilyConnectService
     */
    private $familyConnectService;

    public function __construct(FamilyConnectService $familyConnectService)
    {
        $this->familyConnectService = $familyConnectService;
    }

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
            $this->familyConnectService->connectToFamily($family);
        }

        return $next($request);
    }
}

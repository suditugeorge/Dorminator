<?php

namespace App\Http\Middleware;

use App\Http\Controllers\DormsController;
use Closure;

class StartSorting
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
        return $next($request);
    }
    public function terminate($request, $response)
    {
        DormsController::beginSort();
    }
}

<?php

namespace App\Middlewares;

use Closure;
use Illuminate\Http\Request;

/**
 * Class ForceJsonResponse
 *
 * Add Accept:application/json header to request for forcing json response
 */
class ForceJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $request->headers->set('Accept', 'application/json');

        $response = $next($request);

        $response->header('Content-Type', 'application/json');

        return $response;
    }
}

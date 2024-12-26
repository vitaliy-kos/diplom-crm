<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\Api;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if ( $token === Api::API_TOKEN ) return $next($request);

        return response()->json(['error' => 'Unauthenticated.'], 401);

    }
}

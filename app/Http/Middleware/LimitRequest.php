<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LimitRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedOrigins = ['http://localhost:3000', 'https://www.postman.com','https://frontend.codingfs.com'];
        $origin = $request->headers->get('Origin');
        $userAgent = $request->headers->get('User-Agent');
        if (in_array($origin, $allowedOrigins) || strpos($userAgent, 'PostmanRuntime') !== false) {
            return $next($request);
        }
        return response()->json(['error' => 'Forbidden'], 403);
    }
}

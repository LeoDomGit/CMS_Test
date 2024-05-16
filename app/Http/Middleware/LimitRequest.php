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
        $allowedOrigins = ['http://localhost:3000', 'https://www.getpostman.com','https://frontend.codingfs.com'];
        $origin = $request->header('Origin');

        if (in_array($origin, $allowedOrigins) || $request->header('Postman-Token')) {
            return $next($request);
        }
        return response()->json(['message' => 'Not allowed.'], 403);
    }
}

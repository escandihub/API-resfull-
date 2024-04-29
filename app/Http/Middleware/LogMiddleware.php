<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Log;

class LogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        Log::create([
            'ip_address'        => $request->ip(),
            'method'            => $request->method(),
            'url'               => $request->fullUrl(),
            'status_code'       => $response->status(),
        ]);

        return $next($request);
    }
}

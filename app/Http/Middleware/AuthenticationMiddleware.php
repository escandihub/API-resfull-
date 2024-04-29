<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Token;
use Carbon\Carbon;

class AuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $now    = Carbon::now()->toDateTimeString();
        $token  = Token::where('token', $request->token )->where( 'expiry', '>', $now )->first();

        if (is_null($token) ) {
            return response()->json( 'Acceso Denegado', 401);
        }

        return $next($request);
    }
}

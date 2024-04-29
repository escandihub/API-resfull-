<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class LoginUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|exists:App\Models\user,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 422);
        }
        return $next($request);
    }
}

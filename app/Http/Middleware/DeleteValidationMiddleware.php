<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\customer;

class DeleteValidationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): Response
    {
        \Log::info($request);
        $customer = customer::where('dni',$request)->first();
        
        if ($customer) {
            if ($customer->status == 'A') {
                return $next($request);
            }
        }
        return response()->json( 'Registro no existe', 422 );
        
    }
}

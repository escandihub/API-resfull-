<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Validator;
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
        $dni = $request->route('customer');
      
        $customer = customer::where('dni', $dni)->first();
        if ($customer) {
            if ($customer->status == 'A' || $customer->status == 'I') {
                return $next($request);
            }
        }
        return response()->json(['message' => '“Registro no existe.'], 422);        
    }
}

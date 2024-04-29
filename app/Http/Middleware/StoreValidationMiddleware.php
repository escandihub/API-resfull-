<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\commune;
use App\Models\region;

class StoreValidationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = Validator::make($request->all(),[
            'dni' => 'string|required|unique:customers',
            'id_reg' => 'required|exists:App\Models\region,id_reg',
            'id_com' => 'required|exists:App\Models\commune,id_com',
            'email' => 'required|email|unique:customers',
            'name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
         ]);



         if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 422);
         }

        $commue = commune::find($request->id_com);
        if ($commue) {
            if ($commue->id_reg == $request->id_reg) {
                return $next($request);
            }
            return response()->json(["error" => 'La comuna y region no estan relacionados'], 422);
        }

        
    }
}

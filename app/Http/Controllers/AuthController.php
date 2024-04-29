<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Token;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function store( Request $request ) {
        $password = Hash::make( $request->password );
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $password
        ]);

        return response()->json([
            'message'=>'usuario creado exitosamente',
        ],200);
        
    }
    
    public function login( Request $request ) {
        $user = User::where('email',  $request->email)->first();
        
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales son incorrectas.'],
            ]);
        }

        $date = date('Y-m-d H:i:s');
        $rand = mt_rand(200, 500);
        $expiry = Carbon::now()->addMinutes( 60 )->toDateTimeString();
        $token =  sha1("{$request->email}{$date}{$rand}");
        
        Token::create([
            "email" => $request->email,
            "token" => $token,
            "expiry" => $expiry
        ]);

        return response()->json([
            "token" => $token,
            "message" => "credenciales proporcionadas"
        ], 200);
    }
}

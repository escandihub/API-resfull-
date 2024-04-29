<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CustomerAuth extends Controller
{
    function login(Request $request) {
        $email = $request->email;
    }
}

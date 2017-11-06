<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    const KEY = "Ph6plFa1MYD4lHRpeOdhGmftuZghlmPA";

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(self::KEY);
        } else {
            abort(401);
        }

    }
}

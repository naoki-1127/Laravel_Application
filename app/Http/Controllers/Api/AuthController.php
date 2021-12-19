<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request) {

        $credential = $request ->only('email', 'password');
        Log::debug('get_token');

        if(auth()->attempt($credential)) {
            $user = auth()->user();
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            return ['token' => $token];
        }

        return response([
            'message' => 'Unauthenticated.'
        ], 401);
    }
}

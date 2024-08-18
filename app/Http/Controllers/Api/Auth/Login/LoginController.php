<?php

namespace App\Http\Controllers\Api\Auth\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (auth()->attempt($loginData)) {
            $accessToken = auth()->user()->createToken('authToken', ['server:update'])->accessToken;

            return response(['user' => auth()->user(), 'access_token' => $accessToken]);
        }
        return response(['message' => 'Invalid Credentials']);
    }
}

<?php

namespace App\Http\Controllers\Api\Auth\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Login\UserLoginRequest;

class LoginController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        $loginData = $request->validated();

        if (auth()->attempt($loginData)) {
            $accessToken = auth()->user()->createToken('authToken', ['server:update'])->accessToken;

            return response(['user' => auth()->user(), 'access_token' => $accessToken]);
        }

        return response(['message' => 'Invalid Credentials']);
    }
}

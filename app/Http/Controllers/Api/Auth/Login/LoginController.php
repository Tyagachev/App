<?php

namespace App\Http\Controllers\Api\Auth\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Login\UserLoginRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * @param UserLoginRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function login(UserLoginRequest $request)
    {
        $loginData = $request->validated();
        if (Auth::attempt($loginData)) {
            auth()->user()->createToken('authToken', ['server:update'])->accessToken;
            return response([ 'user' => new UserResource(auth()->user()), 'status' => 200]);
        }
        return response(['message' => 'Invalid Credentials']);
    }
}

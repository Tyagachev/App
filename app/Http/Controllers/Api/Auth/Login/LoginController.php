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
     * Аунтификация пользователя
     *
     * @param UserLoginRequest $request
     * @return Response
     */
    public function login(UserLoginRequest $request): Response
    {
        $loginData = $request->validated();
        if (Auth::attempt($loginData)) {
            auth()->user()->createToken('authToken', ['server:update'])->accessToken;
            return response([ 'user' => new UserResource(auth()->user()), 'status' => 200]);
        }
        return response(['message' => 'Неверные учетные данные']);
    }
}

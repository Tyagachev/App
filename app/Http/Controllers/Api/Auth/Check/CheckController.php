<?php

namespace App\Http\Controllers\Api\Auth\Check;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class CheckController extends Controller
{
    /**
     * Получение данных аунтифицированного
     * пользователя
     *
     * @return Response
     */
    public function authUser(): Response
    {
        return response(new UserResource(Auth::user()));
    }

    /**
     * Проверка на авторизацию пользователя
     *
     * @return Response
     */
    public function authCheck(): Response
    {
        return response(['check' => Auth::check(), 'status' => 200]);
    }
}

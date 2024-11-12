<?php

namespace App\Http\Controllers\Api\Auth\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Registration\UserRegistrationRequest;
use App\Models\User;
use App\Services\Auth\RegistrationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Метод регистрации пользователя
     *
     * @param UserRegistrationRequest $request
     * @param RegistrationService $service
     * @return Response
     * @throws \Exception
     */
    public function register(UserRegistrationRequest $request, RegistrationService $service): Response
    {
        $user = $service->createUser($request->validated());

        Auth::guard()->login($user);

        $accessToken = $user->createToken('authToken')->accessToken;

        if (Auth::user()) {

            $service->createVerifiedNumber(Auth::user());

            return response(['user' => $user, 'access_token' => $accessToken]);
        }
        return response('error');
    }

    /**
     * Метод повторной отправки проверочного кода
     *
     * @param Request $request
     * @param RegistrationService $service
     * @return Response
     * @throws \Exception
     */
    public function sendCodeAgain(Request $request, RegistrationService $service): Response
    {
        $verified = $request->all();
        $user = User::query()->find($verified['uid']);

        return $service->createVerifiedNumber($user);
    }
}

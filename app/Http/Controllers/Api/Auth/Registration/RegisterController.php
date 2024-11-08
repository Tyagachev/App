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
    public function register(UserRegistrationRequest $request, RegistrationService $service): Response
    {
        $user = $service->createUser($request->validated());

        Auth::guard()->login($user);

        $accessToken = $user->createToken('authToken')->accessToken;

        if (auth()->user()) {

            $service->createVerifiedNumber(auth()->user());

            return response(['user' => $user, 'access_token' => $accessToken]);
        }
        return response('error');
    }

    public function sendCodeAgain(Request $request, RegistrationService $service)
    {
        $verified = $request->all();
        $user = User::query()->find($verified['uid']);
        return $service->createVerifiedNumber($user);
    }
}

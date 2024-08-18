<?php

namespace App\Http\Controllers\Api\Auth\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Registration\UserRegistrationRequest;
use App\Services\Auth\RegistrationService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * @param UserRegistrationRequest $request
     * @return Response
     */
    public function register(UserRegistrationRequest $request, RegistrationService $service): Response
    {

        $createdUser = $service->createUser($request);

        if ($service->createVerifiedNumber($createdUser)) {
            Auth::login($createdUser);
            $accessToken = $createdUser->createToken('authToken')->accessToken;

            return response(['user' => $createdUser, 'access_token' => $accessToken]);
        }

        return response('error');

    }
}

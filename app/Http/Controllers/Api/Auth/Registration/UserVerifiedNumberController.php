<?php

namespace App\Http\Controllers\Api\Auth\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Verify\ValidateNumberRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserVerifiedNumberController extends Controller
{
    /**
     * Проверка совпадения проверочного кода
     *
     * @param ValidateNumberRequest $request
     * @return Response
     */
    public function verify(ValidateNumberRequest $request): Response
    {
        $validatedNumber = $request->validated();
        $authUser = Auth::user();
        $authVerify = $authUser->verify;

        if (Auth::id() == $authVerify->uid && $authVerify->number == $validatedNumber['number']) {

            $authVerify->update(['verified' => true]);

            return response(['userId' => Auth::id(), 'verified' => true]);
        }

        return response(['verified' => false]);
    }
}

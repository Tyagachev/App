<?php

namespace App\Http\Controllers\Api\Auth\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Verify\ValidateNumberRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserVerifiedNumberController extends Controller
{
    public function verify(ValidateNumberRequest $request): Response
    {
        $validatedNumber = $request->validated();
        $authUser = auth()->user();
        $authVerify = $authUser->verify;

        if (Auth::user()->id == $authVerify->uid && $authVerify->number == $validatedNumber['number']) {
            //$authUser->update(['email_verified_at' => date('Y-m-d H:i:s.u')]);
            $authVerify->update(['verified' => true]);

            return response(['userId' => auth()->user()->id, 'verified' => true]);
        }

        return response(['verified' => false]);
    }
}

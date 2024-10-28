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
        $auth = auth()->user()->verify;

        if (Auth::user()->id == $auth->uid && $auth->number == $validatedNumber['number']) {
            $auth->update(['verified' => true]);

            return response(['userId' => auth()->user()->id, 'verified' => true]);
        }

        return response(['verified' => false]);
    }
}

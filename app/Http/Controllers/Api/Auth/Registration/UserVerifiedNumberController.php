<?php

namespace App\Http\Controllers\Api\Auth\Registration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserVerifiedNumberController extends Controller
{
    public function verify(Request $request)
    {
        $validatedNumber = $request->validate([
            'number' => 'required|min:6|max:6'
        ]);

        $auth = auth()->user()->verifyNumber;

        if (Auth::user()->id == $auth->uid && $auth->number == $validatedNumber['number']) {

            $auth->update(['verified' => true]);

            return response(['userId' => auth()->user()->id, 'verified' => true]);
        }
        return response(['verified' => false]);
    }
}

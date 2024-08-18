<?php

namespace App\Http\Controllers\Api\Auth\Registration;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{

    public function __construct()
    {
        /*$this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');*/
    }
    public function verify(Request $request)
    {
        $user = User::query()->findOrFail($request->route('id'));

        /*if (! hash_equals((string) $request->route('id'), (string) $user->getKey())) {
            throw new AuthorizationException;
        }*/

        if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'code' => 200,
                'message' => "Verified successfully",
                'success' => false,
                ], 200);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        /*return response()->json([
            'code' => 200,
            'message' => "markEmailAsVerified",
            'success' => true
        ], 200);*/
        return redirect()->route('test', [$user]);
    }
}

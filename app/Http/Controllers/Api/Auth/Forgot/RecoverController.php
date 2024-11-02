<?php

namespace App\Http\Controllers\Api\Auth\Forgot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Forgot\ForgotRequest;
use App\Models\User;
use App\Services\Auth\RecoveryPasswordService;

class RecoverController extends Controller
{
    public function sendResetCode(ForgotRequest $request, RecoveryPasswordService $service)
    {

        return $service->createRecoverNumber($request->validated());
    }
}

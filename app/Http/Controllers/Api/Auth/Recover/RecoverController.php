<?php

namespace App\Http\Controllers\Api\Auth\Recover;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Forgot\ChangePasswordRequest;
use App\Http\Requests\Auth\Forgot\ForgotRequest;
use App\Services\Auth\RecoveryPasswordService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RecoverController extends Controller
{
    /**
     * Отправка проверочного кода
     *
     * @param ForgotRequest $request
     * @param RecoveryPasswordService $service
     * @return Response|null
     * @throws \Exception
     */
    public function sendResetCode(ForgotRequest $request, RecoveryPasswordService $service): Response|null
    {
        return $service->createRecoverNumber($request->validated());
    }

    /**
     * Проверка кода из email
     *
     * @param Request $request
     * @param RecoveryPasswordService $service
     * @return Response
     */
    public function checkRecoveryCode(Request $request, RecoveryPasswordService $service): Response
    {
        $validationField = $request->all();

        return $service->checkCode($validationField['email'], $validationField['number']);
    }

    /**
     * Обновление пароля пользователя
     *
     * @param ChangePasswordRequest $request
     * @param RecoveryPasswordService $service
     * @return Response
     */
    public function resetPassword(ChangePasswordRequest $request, RecoveryPasswordService $service): Response
    {
        return $service->reset($request->validated());
    }
}

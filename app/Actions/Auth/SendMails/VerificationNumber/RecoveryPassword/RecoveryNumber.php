<?php

namespace App\Actions\Auth\SendMails\VerificationNumber\RecoveryPassword;

use App\Actions\Auth\SendMails\VerificationNumber\AbstractVerificationFactory;
use App\Mail\User\Recovery;
use Illuminate\Support\Facades\Mail;

class RecoveryNumber extends AbstractVerificationFactory
{
    /**
     * Отправка кода восстановления пароля
     * на почту
     *
     * @return void
     */
    public function sendMail(): void
    {
        Mail::to($this->email)->send(new Recovery($this->number));
    }
}

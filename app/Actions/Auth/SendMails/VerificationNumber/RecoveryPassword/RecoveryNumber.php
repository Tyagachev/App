<?php

namespace App\Actions\Auth\SendMails\VerificationNumber\RecoveryPassword;

use App\Mail\User\RecoveryNumber;
use Illuminate\Support\Facades\Mail;

class SendMailRecoveryNumber
{
    /**
     * Отправка кода восстановления пароля
     * на почту
     *
     * @param string $email
     * @param int $number
     * @return void
     */
    public function sendRecoveryNumber(string $email, int $number): void
    {
        Mail::to($email)->send(new RecoveryNumber($number));
    }
}

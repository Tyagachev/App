<?php

namespace App\Actions\Auth\SendMails\VerificationNumber\Registration;

use App\Actions\Auth\SendMails\VerificationNumber\AbstractVerificationFactory;
use App\Mail\User\Verified;
use Illuminate\Support\Facades\Mail;

class VerifiedNumber extends AbstractVerificationFactory
{
    /**
     * Отпарвка проверочного кода юзеру на почту
     *
     * @return void
     */
    public function sendMail(): void
    {
        Mail::to($this->email)->send(new Verified($this->number));
    }
}

<?php

namespace App\Actions\Auth\User;

use App\Mail\User\UserCredentials;
use Illuminate\Support\Facades\Mail;

class SendMailUserCredentials
{
    /**
     * Отправка почты и пароля юзеру на почту
     *
     * @param object $user
     * @param string $password
     * @return void
     */
    public function sendMailUser(object $user, string $password): void
    {
        Mail::to($user->email)->send(new UserCredentials($user, $password));
    }
}

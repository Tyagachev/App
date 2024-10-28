<?php

namespace App\Actions\Registration;

use App\Mail\User\VerifiedNumber;
use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\Mail;

class SendMailVerifiedNumber
{

    /**
     * Отпарвка проверочного кода юзеру на почту
     *
     * @param object $user
     * @param object $createNumber
     * @return \Illuminate\Mail\SentMessage|null
     */
    public function sendMailVerify(object $user, object $createNumber): SentMessage|null
    {
        return Mail::to($user->email)->send(new VerifiedNumber($createNumber->number));
    }
}

<?php

namespace App\Actions\Registration;

use App\Mail\User\VerifiedNumber;
use Illuminate\Support\Facades\Mail;

class SendMailVerifiedNumber
{

    /**
     * @param object $user
     * @param object $createNumber
     * @return \Illuminate\Mail\SentMessage|null
     */
    public function sendMailVerify(object $user, object $createNumber)
    {
        return Mail::to($user->email)->send(new VerifiedNumber($createNumber->number));
    }
}

<?php

namespace App\Actions\Auth\SendMails\VerificationNumber;

use App\Actions\Auth\SendMails\VerificationNumber\Interfaces\Factory;

abstract class AbstractVerificationFactory implements Factory
{
    protected string $email;
    protected int $number;
    public function __construct($email, $number)
    {
        $this->email = $email;
        $this->number = $number;
    }
}

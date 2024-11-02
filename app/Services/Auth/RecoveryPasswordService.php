<?php

namespace App\Services\Auth;

use App\Models\RecoveryPassword;
use App\Models\User;

class RecoveryPasswordService
{
    public function createRecoverNumber(array $email)
    {
        $number = random_int(111111, 999999);
        $user = User::query()->where('email', $email)->get()->first();
        if (!$user) {
            return 'Email не найден';
        }

        $recoverCreate = RecoveryPassword::query()->create([
            'email' => $user->email,
            'number' => $number
        ]);
        return $recoverCreate;
    }
}

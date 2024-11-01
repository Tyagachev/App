<?php

namespace App\Services\Auth;

use App\Actions\Registration\SendMailVerifiedNumber;
use App\Models\User;
use App\Models\UserVerifiedNumber;
use Illuminate\Database\Eloquent\Model;

class RegistrationService
{
    /**
     * @param $request
     * @return Model
     */
    public function createUser(array $request): Model
    {
        $user = User::query()->create($request);
        if ($user->id == 1) {
            $user->role()->create([
                'uid' => $user->id,
                'role' => 1
            ]);

            return $user;
        } else {
            $user->role()->create([
                'uid' => $user->id,
                'role' => 0
            ]);
        }

        return $user;
    }

    public function createVerifiedNumber(object $user)
    {
        $createNumber = new UserVerifiedNumber();
        $createNumber->number = random_int(111111, 999999);

        $action = new SendMailVerifiedNumber();
        $action->sendMailVerify($user, $createNumber);

        return $user->verify()->save($createNumber);
    }

}

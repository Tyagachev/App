<?php

namespace App\Services\Registration;

use App\Actions\Registration\SendMailVerifiedNumber;
use App\Models\User;
use App\Models\UserVerifiedNumber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationService
{
    /**
     * @param Request $request
     * @return Model
     */
    public function createUser(Request $request): User
    {
        $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $user;
    }

    /**
     * @param object $user
     * @return mixed
     * @throws \Exception
     */
    public function createVerifiedNumber(object $user)
    {
        $createNumber = new UserVerifiedNumber();

        $createNumber->number = random_int(111111, 999999);

        $action = new SendMailVerifiedNumber();

        $action->sendMailVerify($user, $createNumber);

        return $user->verifyNumber()->save($createNumber);
    }

}

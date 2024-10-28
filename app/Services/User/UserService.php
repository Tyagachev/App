<?php

namespace App\Services\User;

use App\Actions\User\SendMailUserCredentials;
use App\Models\User;
use App\Models\UserVerifiedNumber;
use Illuminate\Support\Str;

class UserService
{
    /**
     * Метод добавления юзера вручную
     *
     * @param array $data
     * @return bool|array
     */
    public function manualCreateUser(array $data): bool|array
    {
        $password = ($data['password'] == null) ? Str::random(8) : $data['password'];

        $user = User::query()->create([
           'name' => $data['name'],
           'email' => $data['email'],
           'password' => $password
        ]);

        $role = $this->createRole($user, $data);
        $verifiedNumber = $this->createVerifiedNumber($user);

        if ($role && $verifiedNumber) {
            $send = new SendMailUserCredentials();
            $send->sendMailUser($user, $password);

            return [
                'email' => $user->email,
                'name' => $user->name,
                'password' => $password
            ];
        }
        return false;
    }

    /**
     * Создание роли для юзера
     *
     * @param object $user
     * @param array $data
     * @return bool
     */
    public function createRole(object $user, array $data): bool
    {
        $user->role()->create([
            'uid' => $user->id,
            'role' => $data['role']
        ]);
        return true;
    }

    /**
     * Добавление в БД запись о проверочном коде
     *
     * @param object $user
     * @return bool
     * @throws \Exception
     */
    public function createVerifiedNumber(object $user): bool
    {
        UserVerifiedNumber::query()->create([
            'uid' => $user->id,
            'number' => random_int(111111, 999999),
            'verified' => true
        ]);
        return true;
    }
}

<?php

namespace App\Services\Auth;

use App\Actions\Auth\RecoveryPassword\SendMailRecoveryNumber;
use App\Models\RecoveryPassword;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RecoveryPasswordService
{
    /**
     * Создает запись в БД с email и проверочным кодом
     * если запись была ранее была, то обновляет проверочный код
     *
     * @param array $email
     * @return Response|void
     * @throws \Exception
     */
    public function createRecoverNumber(array $email): Response
    {
        $user = User::query()->where('email', $email)->first();

        if (is_null($user)) {
            return response('Email не найден', 404);
        }

        $hasRecoveryNumber = RecoveryPassword::query()->where('email', $user->email)->first();

        $number = random_int(111111, 999999);
        $sendNumber = new SendMailRecoveryNumber();

        if ($user && $hasRecoveryNumber) {
            $hasRecoveryNumber->update(['number' => $number]);
            $sendNumber->sendRecoveryNumber( $user->email, $number);
            return response($user->email, 201);

        } elseif ($user && !$hasRecoveryNumber) {
            $sendNumber->sendRecoveryNumber($user->email, $number);

            $create = RecoveryPassword::query()->create([
                'email' => $user->email,
                'number' => $number
            ]);
            return response($create, 201);
        }
    }

    /**
     * Проверка совпадает ли email и пароль в таблице
     *
     * @param string $email
     * @param int $number
     * @return Response
     */
    public function checkCode(string $email, int $number): Response
    {
        $check = RecoveryPassword::query()
            ->where( 'email', '=', $email)
            ->where('number', '=', $number)
            ->first();

        if ($check) {
            return response('Checked', 200);
        }
        return response('No-checked', 404);
    }

    /**
     * Обновляем пароль
     *
     * @param array $data
     * @return Response
     */
    public function reset(array $data): Response
    {
        User::query()
            ->where('email', '=', $data['email'])
            ->update(['password' => Hash::make($data['password'])]);

        return response('Updated', 201);
    }
}

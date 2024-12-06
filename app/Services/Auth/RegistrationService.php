<?php

namespace App\Services\Auth;

use App\Actions\Auth\SendMails\VerificationNumber\Registration\VerifiedNumber;
use App\Models\User;
use App\Models\UserVerifiedNumber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class RegistrationService
{
    /**
     * Создание нового пользователя
     * Если пользователь зарегистрировался первым,
     * то выдается роль админа
     * В остальных случаях пользователя
     *
     * @param array $request
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

    /**
     * Создание проверочного кода для подтверждения
     * Если код был ранее создан перезаписывает на новое значение
     * если нет создает запись в таблице
     * В обоих случаях вызывает метод запуска экшена отправки
     *
     * @param object $user
     * @return Response
     * @throws \Exception
     */
    public function createVerifiedNumber(object $user): Response
    {
        //объект класса для получения поля number
        $createNumber = new UserVerifiedNumber();
        //подготовка к отправки письма, сбор данных
        $sendNumber = new VerifiedNumber($user->email, $createNumber->number = random_int(111111, 999999));

        if (UserVerifiedNumber::query()->where('uid', '=', $user->id)->first()) {
            $user->verify()->update(['number' => $createNumber->number]);
            //отправка письма
            $sendNumber->sendMail();

            return response('Code send again', 200);
        } else {
            $user->verify()->save($createNumber);
            //отправка письма
            $sendNumber->sendMail();

            return response('Created code', 201);
        }
    }
}

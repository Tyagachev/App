<?php

namespace App\Services\Generate;

use Illuminate\Support\Str;

class GenerateService
{

    /**
     * Метод для генерации пароля при создании
     * пользователя вручную
     *
     * @return string
     * @throws \Exception
     */
    public function generatePassword(): string
    {
        $length = random_int(8, 12);
        return Str::random($length);
    }
}

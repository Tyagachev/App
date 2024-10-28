<?php

namespace App\Services\Generate;

use Illuminate\Support\Str;

class GenerateService
{

    /**
     * @return string
     * @throws \Exception
     */
    public function generatePassword(): string
    {
        $length = random_int(8, 12);
        return Str::random($length);
    }
}

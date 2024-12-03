<?php

namespace App\Services\Hint;

use App\Models\Hint;

class HintService
{
    /**
     * Обновления записи в БД подсказок
     *
     * @param array $data
     * @return bool|int
     */
    public function updateHint(array $data): bool|int
    {

        return Hint::query()->find($data['hintId'])->update([
            'hint' => str_replace(["\r\n", "\r", "\n"], "<br/>", $data['hintValue'])
        ]);
    }
}

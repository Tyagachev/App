<?php

namespace App\Services\Answer;

use App\Models\Answer;
use Illuminate\Http\Response;

/**
 *
 */
class AnswerService
{
    /**
     * Сервис удаления ответа
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function destroyAnswer(string $id): Response
    {
        $answer = Answer::query()->find($id);
        $answer->delete();
        return response('Destroy', 200);
    }
}

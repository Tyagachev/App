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
     * @param string $id
     * @return Response
     */
    public function destroyAnswer(string $id): Response
    {
        $answer = Answer::query()->find($id);
        $answer->delete();
        return response('Destroy', 200);
    }
}

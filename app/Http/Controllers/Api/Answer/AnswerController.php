<?php

namespace App\Http\Controllers\Api\Answer;

use App\Http\Controllers\Controller;
use App\Services\Answer\AnswerService;
use Illuminate\Http\Response;

class AnswerController extends Controller
{
    /**
     * Удаление ответа на билет
     *
     * @param string $id
     * @param AnswerService $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function destroy(string $id, AnswerService $service): Response
    {
        return $service->destroyAnswer($id);
    }
}

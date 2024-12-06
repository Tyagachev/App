<?php

namespace App\Http\Controllers\Api\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Resources\Feedback\FeedbackResource;
use App\Models\Feedback;
use App\Services\Feedback\FeedbackService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    /**
     * Получение списка отзвывов
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function index(): Response
    {
        $feedCollection = FeedbackResource::collection(Feedback::all()->sortDesc());
        return response($feedCollection);
    }

    /**
     * Проверка на то есть ли отзыв у пользователя
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function show(int $id): Response
    {
        return response(Feedback::query()
            ->where('user_id', '=', $id)->first('id'));
    }

    /**
     * Запись отзыва в БД
     *
     * @param Request $request
     * @param FeedbackService $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function store(Request $request, FeedbackService $service): Response
    {
        $feedbackForm = $request->all();
        $service->storeFeedback($feedbackForm['form']);
        return response('Created', 201);
    }

}

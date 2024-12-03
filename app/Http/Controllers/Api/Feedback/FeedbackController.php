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
     * Display a listing of the resource.
     */
    public function index()
    {
        return FeedbackResource::collection(Feedback::all());
    }

    public function show($id)
    {

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

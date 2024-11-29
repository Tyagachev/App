<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Services\Task\TaskService;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Выводит один вопрос
     *
     * @param Request $request
     * @param TaskService $service
     * @return Response
     */
    public function index(Request $request, TaskService $service): Response
    {
        $oneTask = $service->getTask($request->all());
        if (!count($oneTask)) {
            return response('No found');
        }
        return response($oneTask);
    }

    /**
     * Запись данных в БД
     *
     * @param Request $request
     * @param TaskService $service
     * @return Response
     */
    public function store(Request $request, TaskService $service): Response
    {
        return $service->storeTaskAnswers($request->all());
    }

    /**
     * Показывает результаты теста
     *
     * @param $id
     * @param TaskService $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function show($id, TaskService $service): Application|Response
    {
        return response($service->getTaskResult($id));
    }

    /**
     * Удаление записей о прохождении теста
     *
     * @param Request $request
     * @param TaskService $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function destroy(Request $request, TaskService $service): Application|Response
    {
        return $service->destroyTasksAnswers($request->get('id'));
    }
}

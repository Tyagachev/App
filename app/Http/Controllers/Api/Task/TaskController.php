<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Services\Task\TaskService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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
        return response($service->storeTaskAnswer($request->all()));
    }

    public function show($id, TaskService $service)
    {
        return response($service->getTaskResult($id));
    }
}

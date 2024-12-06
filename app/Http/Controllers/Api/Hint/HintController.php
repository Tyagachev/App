<?php

namespace App\Http\Controllers\Api\Hint;

use App\Http\Controllers\Controller;
use App\Http\Resources\Hint\HintResource;
use App\Models\Hint;
use App\Services\Hint\HintService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HintController extends Controller
{

    /**
     * Вывод списка подсказок
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function index(): Response
    {
        $hints = Hint::all()->sortDesc();
        return response(HintResource::collection($hints));
    }

    /**
     * Получение подсказки по id билета
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function show($id): Response
    {
        return response(new HintResource(Hint::query()->find($id)));
    }

    /**
     * Обновление подсказок
     *
     * @param Request $request
     * @param HintService $service
     * @return bool|int
     */
    public function update(Request $request, HintService $service): bool|int
    {
        return $service->updateHint($request->all());
    }

}

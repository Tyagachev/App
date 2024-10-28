<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Получение пользователя по ID
     * @param $id
     * @return Response
     */
    public function index($id): Response
    {
        return response(new UserResource(User::query()->findOrFail($id)));
    }


    /**
     * Получение данных аунтифицированного
     * пользователя
     *
     * @return Response
     */
    public function auth(): Response
    {
        $user = auth()->user();
        return response(new UserResource($user));
    }

    /**
     * Добавление пользователя вручную
     *
     * @param CreateUserRequest $request
     * @param UserService $service
     * @return Response
     */
    public function create(CreateUserRequest $request, UserService $service): Response
    {
        $create = $service->manualCreateUser($request->validated());

        return response($create, 201);
    }

    /**
     * Получение списка всех пользователей
     *
     * @return Response
     */
    public function getAllUser(): Response
    {
        return response (UserResource::collection(User::all()));
    }
}

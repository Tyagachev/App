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
     * Получение списка всех пользователей
     *
     * @return Response
     */
    public function index(): Response
    {
        $users = User::all()->reverse();
        $userCollection = UserResource::collection($users );

        return response($userCollection);
    }

    /**
     * Получение пользователя по ID
     *
     * @param $id
     * @return Response
     */
    public function show($id): Response
    {
        $user = new UserResource(User::query()->findOrFail($id));

        return response($user);
    }

    /**
     * Добавление пользователя вручную
     *
     * @param CreateUserRequest $request
     * @param UserService $service
     * @return Response
     */
    public function store(CreateUserRequest $request, UserService $service): Response
    {
        $create = $service->manualCreateUser($request->validated());

        return response($create, 201);
    }

}

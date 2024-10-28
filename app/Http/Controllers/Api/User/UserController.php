<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @param $id
     * @return Response
     */
    public function index($id): Response
    {
        $user = User::query()->findOrFail($id);
        return response(new UserResource($user));
    }


    public function auth()
    {
        $user = auth()->user();
        return response(new UserResource($user));
    }


    public function create(CreateUserRequest $request, UserService $service)
    {
        $create = $service->manualCreateUser($request->validated());

        return response($create, 201);
    }

    /**
     * Получение списка юзеров
     * @return Collection
     */
    public function getAllUser(): Collection
    {
        return User::all();
    }
}

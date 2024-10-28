<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class   TestAuthController extends Controller
{
    public function test($id)
    {
        $user = User::query()->findOrFail($id);
        return response(new UserResource($user));
    }
}

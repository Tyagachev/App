<?php

namespace App\Http\Controllers\Api\Generate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Generate\GenerateRequest;
use App\Services\Generate\GenerateService;
use Illuminate\Http\Request;

class GenerateController extends Controller
{

    /**
     * @param Request $request
     * @param GenerateService $service
     * @return false|string
     */
    public function create(Request $request, GenerateService $service): false|string
    {
        if ($request->input()) {
            return $service->generatePassword();
        }
        return false;
    }
}

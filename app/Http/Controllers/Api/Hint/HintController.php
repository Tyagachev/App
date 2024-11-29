<?php

namespace App\Http\Controllers\Api\Hint;

use App\Http\Controllers\Controller;
use App\Http\Resources\Hint\HintResource;
use App\Models\Hint;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HintController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function index(): Response
    {
        $hints = Hint::all();
        return response(HintResource::collection($hints));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

}

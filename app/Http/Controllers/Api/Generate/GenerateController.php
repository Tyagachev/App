<?php

namespace App\Http\Controllers\Api\Generate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Generate\GenerateRequest;
use App\Services\Generate\GenerateService;
use Illuminate\Http\Request;

class GenerateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

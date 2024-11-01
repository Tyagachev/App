<?php

namespace App\Http\Controllers\Api\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Resources\Ticket\TicketResource;
use App\Models\Ticket;
use App\Services\Ticket\TicketService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(TicketResource::collection(Ticket::all()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Добавление билетов и вопросов к ним
     *
     * @param Request $request
     * @param TicketService $service
     * @return Response
     */
    public function store(Request $request, TicketService $service): Response
    {
        if ($service->storeTicket($request->all())) {
            return response('Created', 201);
        }
        return response('Error');
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
     * Удаление билет и ответов
     *
     * @param string $id
     * @param TicketService $service
     * @return bool
     */
    public function destroy(string $id, TicketService $service): bool
    {
        return $service->destroyTicket($id);
    }
}

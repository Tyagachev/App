<?php

namespace App\Http\Controllers\Api\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketRequest;
use App\Http\Resources\Ticket\TicketResource;
use App\Models\Ticket;
use App\Services\Ticket\TicketService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 *
 */
class TicketController extends Controller
{

    /**
     * Получение списка всех билетов
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(TicketResource::collection(Ticket::all()));
    }

    /**
     * Добавление билетов и вопросов к ним
     *
     * @param TicketService $service
     * @return Response
     */
    public function store(TicketRequest $request, TicketService $service): Response
    {
        if ($service->storeTicket($request->validated())) {

            return response('Created', 201);
        }

        return response(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Получение данных одного билета
     * для редактирования
     *
     * @param string $id
     *@return Response
     */
    public function edit(string $id): Response
    {
        return response(new TicketResource(Ticket::query()->find($id))) ;
    }


    /**
     * Редактирование контента билета
     *
     * @param Request $request
     * @param TicketService $service
     * @return Response
     */
    public function update(Request $request, TicketService $service): Response
    {
        return $service->updateTicket($request->all());
    }


    /**
     * Удаление билета
     *
     * @param string $id
     * @param TicketService $service
     * @return Response
     */
    public function destroy(string $id, TicketService $service): Response
    {
        $service->destroyTicket($id);

        return response('Destroy', 201);
    }
}

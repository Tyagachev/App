<?php

namespace App\Services\Task;

use App\Http\Resources\Ticket\TicketResource;
use App\Models\Task;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TaskService
{
    /**
     * Получение одного задания
     *
     * @param array $id
     * @return AnonymousResourceCollection
     */
    public function getTask(array $id): AnonymousResourceCollection
    {
        $userTicket = User::query()->find($id['id']);

        $idx = [];
        foreach ($userTicket->tasks as $ut) {
            $idx[] = $ut['ticket_id'];
        }

        $resource = TicketResource::collection(Ticket::query()
            ->whereNotIn('id', $idx)
            ->limit(1)
            ->get()
        );

        return $resource;
    }

    /**
     * Запись в таблицу
     *
     * @param array $data
     * @return Response
     */
    public function storeTaskAnswer(array $data): Response
    {
        $user = User::query()->find($data['user_id']);
        $user->tasks()->create($data);
        return response('Create', 200);
    }

    public function getTaskResult(int $id)
    {
        return Task::query()->select('tickets.content','answers.answer','answers.answer', 'answers.picked')
            ->join('tickets', 'tickets.id', '=' ,'tasks.ticket_id')
            ->join('answers', 'answers.id', '=', 'tasks.answer_id')
            ->join('users', 'users.id','=', 'tasks.user_id')
            ->where('tasks.user_id', '=', $id )
            ->where('answers.picked', '=', 0)->get();
    }
}

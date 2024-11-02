<?php

namespace App\Services\Ticket;

use App\Models\Answer;
use App\Models\Ticket;

class TicketService
{
    protected object $ticket;
    /**
     * @param $data
     * @return boolean
     */
    public function storeTicket($data): bool
    {
        $this->ticket = Ticket::query()->create([
            'title' => $data['title'],
            'content' => $data['content']
        ]);

        foreach ($data['answers'] as $answer) {
            $answer['answer'] = str_replace(["\r\n", "\r", "\n"], "<br/>", $answer['answer']);
            $inArray = $answer + ['ticket_id' => $this->ticket->id];
            Answer::query()->create($inArray);
        }

        return true;
    }

    /**
     * Удаление билета и ответы на билет
     *
     * @param integer $id
     * @return bool
     */
    public function destroyTicket(int $id): bool
    {
        $ticket = Ticket::query()->find($id);
        $ticket->answers()->delete();

        return $ticket->delete();
    }
}

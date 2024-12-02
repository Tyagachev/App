<?php

namespace App\Services\Ticket;

use App\Models\Answer;
use App\Models\Hint;
use App\Models\Ticket;
use Illuminate\Http\Response;

class TicketService
{
    /**
     * @param array $data
     * @return boolean
     */
    public function storeTicket(array $data): bool
    {
        $ticket = Ticket::query()->create([
            'title' => $data['title'],
            'content' => $data['content']
        ]);

        $this->addTicketIdToHint($ticket);

        foreach ($data['answers'] as $answer) {
            $answer['answer'] = str_replace(["\r\n", "\r", "\n"], "<br/>", $answer['answer']);
            $inArray = $answer + ['ticket_id' => $ticket->id];
            Answer::query()->create($inArray);
        }


        return true;
    }

    /**
     * @param array $field
     * @return Response
     */
    public function updateTicket(array $field): Response
    {
        $ticket = Ticket::query()->find($field['id']);
        $ticket->update([
            'title' => $field['title'],
            'content' => $field['content']
        ]);
        foreach ($field['answers'] as $answer) {
            try {
                $update = $ticket->answers()->where('id', $answer['id']);
                $answer['answer'] = str_replace(["\r\n", "\r", "\n"], "<br/>", $answer['answer']);
                $update->update($answer);
            } catch (\Exception) {
                $update->create($answer);
            }
        }
        return response('Updated', 200);
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
        if (empty($ticket->answers)) {
            $ticket->delete();
        }
        $ticket->answers()->delete();

        return $ticket->delete();
    }

    private function addTicketIdToHint(object $ticket): void
    {
        $hint = new Hint();
        $hint->hint = '...';
        $hint->ticket_id = $ticket->id;
        $ticket->hint()->save($hint);
    }
}

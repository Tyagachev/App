<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ticket_name' => $this->ticket_name,
            'original_ticket_width' => $this->original_ticket_width,
            'original_ticket_height' => $this->original_ticket_height,
            'width' => $this->width,
            'height' => $this->height,
            'control' => $this->control,
            'rootlet' => $this->rootlet,
            'ticket_variables' => $this->coordinates
        ];
    }
}

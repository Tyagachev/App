<?php

namespace App\Http\Resources\Hint;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HintResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'hint' => $this->hint,
            'ticket' => $this->ticket
        ];
    }
}

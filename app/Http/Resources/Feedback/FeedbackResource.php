<?php

namespace App\Http\Resources\Feedback;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user->id,
            'name' => $this->user->name,
            'score' => $this->score,
            'comment'=> $this->comment,
            'created_at' => date('d.m.Y', strtotime($this->created_at))
        ];
    }
}

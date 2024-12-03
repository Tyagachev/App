<?php

namespace App\Services\Feedback;

use App\Models\User;

class FeedbackService
{
    public function storeFeedback(array $data)
    {
        $user =  User::query()->find($data['user_id']);
        $data['comment'] = str_replace(["\r\n", "\r", "\n"], "<br/>",  $data['comment']);
        return $user->feeds()->create($data);
    }
}

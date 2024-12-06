<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Feedback\FeedbackResource;
use App\Models\Feedback;
use App\Models\Task;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TestAuthController extends Controller
{
    public int $id = 1;
    private string $host = 'localhost';
    private string $dbName = 'app';
    private string $userName = 'root';
    private string $password = '';
    /*public function test()
    {
        $connect = mysqli_connect(
            "$this->host",
            "$this->userName",
            "$this->password",
            "$this->dbName");

        $sql = "SELECT name, email, created_at FROM users WHERE id = $this->id";

        $res = mysqli_query($connect, $sql)->fetch_object();

        return json_encode($res);
    }*/

    public function test2(Request $request)
    {
        /*$data = [
            'ticket_id' => 1,
            'answer_id' => 1,
            'user_id' => 1
        ];
        $user =  User::query()->where('id', $data['user_id'])->first();
        $user->tasks()->create($data);*/
        /*$task = Task::query()
            ->select('tickets.content','answers.answer','answers.answer', 'answers.picked')
            ->join('tickets', 'tickets.id', '=' ,'tasks.ticket_id')
            ->join('answers', 'answers.id', '=', 'tasks.answer_id')
            ->join('users', 'users.id','=', 'tasks.user_id')
            ->where('tasks.user_id', '=', 1)->get();
        dd($task);*/
        /*$ticket = Ticket::query()->find(3);
        if (sizeof($ticket->answers) === 0) {
            $ticket->delete();
        }*/
       /* $t = Task::query()->select('tasks.id')
            ->join('tickets', 'tickets.id', '=', 'tasks.ticket_id')
            ->join('users', 'users.id', '=', 'tasks.user_id')
            ->where('users.id', '=', 1)->count();
        dd($t);*/
        $user =  User::query()->find($this->id);
        dd(gettype($user->email)) ;
    }
}





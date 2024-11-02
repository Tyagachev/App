<?php

namespace App\Http\Controllers\Api\Statistics;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function getCountUsers()
    {
        return User::all()->count();
    }

    public function getCountTickets()
    {
        return Ticket::all()->count();
    }
}

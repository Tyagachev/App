<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * Точка входа
     *
     * @return View
     */
    public function index(): View
    {
        return view('index');
    }
}

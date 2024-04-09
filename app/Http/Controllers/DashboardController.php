<?php

namespace App\Http\Controllers;

use App\Models\Question;
use illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): view
    {
        //dd('OI');

        return view('dashboard', [
            'questions' => Question::all(),
        ]);
    }
}

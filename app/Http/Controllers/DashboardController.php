<?php

namespace App\Http\Controllers;

use App\Models\Question;
use illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): view
    {

        return view('dashboard', [
            'questions' => Question::withSum('votes', 'like')
                ->withSum('votes', 'unlike')
                ->get(),
        ]);
    }
}

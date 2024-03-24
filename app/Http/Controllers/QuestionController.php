<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    //método response
    public function store(): RedirectResponse
    {

        $attributes = request()->validate([
            'question' => ['required'],
        ]);

        Question::query()->create($attributes);

        return to_route('dashboard');

    }
}

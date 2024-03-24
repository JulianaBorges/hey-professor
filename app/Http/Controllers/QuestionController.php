<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    //metodo response
    public function store(): RedirectResponse
    {

        $attributes = request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value[strlen($value) - 1] != '?') {
                        $fail('Verifique se há ponto de interrogação no final da frase.');
                    }
                },
            ],
        ]);

        Question::query()->create($attributes);

        return to_route('dashboard');

    }
}

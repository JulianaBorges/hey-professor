<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, post};

it(
    'should be able to like a question',
    function () {

        //Arrange
        $user     = User::factory()->create();
        $question = Question::factory()->create();

        //act
        actingAs($user);

        post(route('question.like', $question))
            ->assertRedirect();

        //Assert
        assertDatabaseHas('votes', [
            'question_id' => $question->id,
            'like'        => 1,
            'unlike'      => 0,
            'user_id'     => $user->id,
        ]);
    }
);

it(
    'should not be able to like more than 1 time',
    function () {

        //arrange
        $user     = User::factory()->create();
        $question = Question::factory()->create();

        //act
        actingAs($user);
        post(route('question.like', $question));
        post(route('question.like', $question));
        post(route('question.like', $question));
        post(route('question.like', $question));
        post(route('question.like', $question));

        //Assert
        expect($user->votes()->where('question_id', '=', $question->id)->get())
            ->tohaveCount(1);

    }
);

it(
    'should be able to unlike a question',
    function () {

        //Arrange
        $user     = User::factory()->create();
        $question = Question::factory()->create();

        //act
        actingAs($user);

        post(route('question.unlike', $question))
            ->assertRedirect();

        //Assert
        assertDatabaseHas('votes', [
            'question_id' => $question->id,
            'like'        => 0,
            'unlike'      => 1,
            'user_id'     => $user->id,
        ]);
    }
);

it(
    'should not be able to unlike more than 1 time',
    function () {

        //arrange
        $user     = User::factory()->create();
        $question = Question::factory()->create();

        //act
        actingAs($user);
        post(route('question.unlike', $question));
        post(route('question.unlike', $question));
        post(route('question.unlike', $question));
        post(route('question.unlike', $question));
        post(route('question.unlike', $question));

        //Assert
        expect($user->votes()->where('question_id', '=', $question->id)->get())
            ->tohaveCount(1);

    }
);

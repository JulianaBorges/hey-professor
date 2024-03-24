<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post, };

it('should be able to create a new question bigger than 255 characters', function () {

    //Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    //Act :: agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    //assert :: verificar
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);

});

it('valida se o ultimo caracter é o ponto de interrogação', function () {

})->todo();

it('valida se ter mais de 10 caracteres ', function () {

    //Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    //Act :: agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 5) . '?',
    ]);

    //assert :: verificar
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseCount('questions', 0);

});

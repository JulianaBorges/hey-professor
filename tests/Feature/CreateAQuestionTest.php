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

it('valida se o ultimo caractere é um ponto de interrogação', closure: function () {

    $user = User::factory()->create();
    actingAs($user);

    // Act :: agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10),
    ]);

    // Assert :: verificar
    $request->assertSessionHasErrors([
        'question' => 'Are you sure that is a question? It is missing the question mark in the end.',
    ]);
    assertDatabaseCount('questions', 0);
});

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

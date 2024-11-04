<?php

use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('client users can authenticate using the login screen', function () {
    $client = \Spatie\Permission\Models\Role::create(['name' => 'client']);
    $user = User::factory()->create();
    $user->assignRole('client');

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect('/');
});

test('partner users can authenticate using the login screen', function () {
    $partner = \Spatie\Permission\Models\Role::create(['name' => 'partner']);
    $user = User::factory()->create();
    $user->assignRole('partner');

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(\App\Providers\RouteServiceProvider::HOME);
});

test('administrator users can authenticate using the login screen', function () {
    $administrator = \Spatie\Permission\Models\Role::create(['name' => 'administrator']);
    $user = User::factory()->create();
    $user->assignRole('administrator');

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(\App\Providers\RouteServiceProvider::HOME);
});

test('users cannot authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

<?php

use App\Providers\RouteServiceProvider;

test('registration screen can not be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(404);
});

test('new users can not register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertStatus(404);
    
    $this->assertGuest();
});

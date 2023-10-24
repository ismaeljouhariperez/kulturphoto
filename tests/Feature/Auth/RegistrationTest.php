<?php

use App\Providers\RouteServiceProvider;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'surname' => 'User Surname',
        'nickname' => 'testNickname',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'address' => '123 Test Address',
        'postalCode' => '67200',
        'city' => 'Test city',
        'description' => 'This is a user description limited to 300 characters.',
        'gender' => 'Female',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'phone_number' => '0123456789',
        // No profile picture test here as it involves file uploads.
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

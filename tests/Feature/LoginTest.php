<?php

namespace Tests\Feature\Feature;

use App\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                'email'     => ['The email field is required.'],
                'password'  => ['The password field is required.'],
            ]);
    }


    public function testUserLoginsSuccessfully()
    {
        $user = factory(User::class)->create([
            'email'     => 'test@test.com',
            'password'  => bcrypt('foobar123'),
        ]);

        $payload = [
            'email'     => 'test@test.com',
            'password'  => 'foobar123'
        ];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'created_at',
                'updated_at',
                'api_token',
            ]);

    }
}
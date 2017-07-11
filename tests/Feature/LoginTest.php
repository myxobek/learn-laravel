<?php

namespace Tests\Feature\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
            'email'     => 'test@user.com',
            'password'  => bcrypt('foobar123'),
        ]);

        $payload = [
            'email'     => 'test@user.com',
            'password'  => 'foobar123'
        ];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);

    }
}
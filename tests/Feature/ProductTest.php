<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    private $_headers = [];

    public function setUp()
    {
        parent::setUp();
        $user           = factory(User::class)->create();
        $token          = $user->generateToken();
        $this->_headers = ['Authorization' => "Bearer $token"];
    }

    public function testProductsAreListedCorrectly()
    {
        factory(Product::class)->create([
            'name'          => 'test1@test.com',
            'price'         => 42,
            'vouchers_ids'  => '[]'
        ]);

        factory(Product::class)->create([
            'name'          => 'test2@test.com',
            'price'         => 4242,
            'vouchers_ids'  => '[1,2]'
        ]);

        $this->json('GET', '/api/products', [], $this->_headers)
            ->assertStatus(200)
            ->assertJson([
                [
                    'name'          => 'test1@test.com',
                    'price'         => 42,
                    'vouchers_ids'  => '[]'
                ],
                [
                    'name'          => 'test2@test.com',
                    'price'         => 4242,
                    'vouchers_ids'  => '[1,2]'
                ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'price', 'vouchers_ids', 'created_at', 'updated_at'],
            ]);
    }

    public function testsProductIsCreatedCorrectly()
    {
        $payload = [
            'name'          => 'test@test.com',
            'price'         => 42,
            'vouchers_ids'  => '[]'
        ];

        $this->json('POST', '/api/products', $payload, $this->_headers)
            ->assertStatus(200)
            ->assertJson([
                'id'            => 1,
                'name'          => 'test@test.com',
                'price'         => 42,
                'vouchers_ids'  => '[]'
            ]);
    }
}

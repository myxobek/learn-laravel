<?php

namespace Tests\Feature;

use App\Product;
use App\ProductVoucher;
use App\User;
use App\Voucher;
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
        ]);

        factory(Product::class)->create([
            'name'          => 'test2@test.com',
            'price'         => 4242,
        ]);

        factory(Voucher::class)->create([
            'date_from' => date('Y-m-d H:i:s', strtotime('-1 days')),
            'date_till' => date('Y-m-d H:i:s', strtotime('+1 days')),
            'discount'  => 20
        ]);

        factory(Voucher::class)->create([
            'date_from' => date('Y-m-d H:i:s', strtotime('-3 days')),
            'date_till' => date('Y-m-d H:i:s', strtotime('-2 days')),
            'discount'  => 25
        ]);

        factory(ProductVoucher::class)->create([
            'product_id' => 2,
            'voucher_id' => 1
        ]);

        factory(ProductVoucher::class)->create([
            'product_id' => 2,
            'voucher_id' => 2
        ]);

        $this->json('GET', '/api/products', [], $this->_headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'name', 'price'],
            ])
            ->assertJson([
                [
                    'id'    => 1,
                    'name'  => 'test1@test.com',
                    'price' => 42
                ],
                [
                    'id'    => 2,
                    'name'  => 'test2@test.com',
                    'price' => 3393
                ],
            ]);
    }

    public function testsProductIsCreatedCorrectly()
    {
        $payload = [
            'name'          => 'test@test.com',
            'price'         => 42,
        ];

        $this->json('POST', '/api/products', $payload, $this->_headers)
            ->assertStatus(200)
            ->assertJson([
                'id'            => 1,
                'name'          => 'test@test.com',
                'price'         => 42,
            ]);
    }
}

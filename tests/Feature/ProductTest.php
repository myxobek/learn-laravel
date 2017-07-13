<?php

namespace Tests\Feature;

use App\Product;
use App\ProductVoucher;
use App\User;
use App\Voucher;
use Tests\TestCase;

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

        factory(Voucher::class)->create([
            'date_from' => date('Y-m-d H:i:s', strtotime('-1 days')),
            'date_till' => date('Y-m-d H:i:s', strtotime('+1 days')),
            'discount'  => 90
        ]);

        factory(ProductVoucher::class)->create([
            'product_id' => 2,
            'voucher_id' => 3
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
                    'price' => 1696
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

    public function testsProductIsBoughtCorrectly()
    {
        $product1 = factory(Product::class)->create([
            'name'          => 'test1@test.com',
            'price'         => 42,
        ]);

        $product2 = factory(Product::class)->create([
            'name'          => 'test2@test.com',
            'price'         => 4242,
        ]);

        $voucher1 = factory(Voucher::class)->create([
            'date_from' => date('Y-m-d H:i:s', strtotime('-1 days')),
            'date_till' => date('Y-m-d H:i:s', strtotime('+1 days')),
            'discount'  => 20
        ]);

        factory(Voucher::class)->create([
            'date_from' => date('Y-m-d H:i:s', strtotime('-1 days')),
            'date_till' => date('Y-m-d H:i:s', strtotime('+1 days')),
            'discount'  => 20
        ]);

        factory(ProductVoucher::class)->create([
            'product_id' => 2,
            'voucher_id' => 1
        ]);

        factory(ProductVoucher::class)->create([
            'product_id' => 1,
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
                    'price' => 33
                ],
                [
                    'id'    => 2,
                    'name'  => 'test2@test.com',
                    'price' => 2545
                ],
            ]);

        $this->json('PUT', '/api/products/' . $product1->id . '/buy', [], $this->_headers)
            ->assertStatus(200);

        $this->json('GET', '/api/products', [], $this->_headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'name', 'price'],
            ])
            ->assertJson([
                [
                    'id'    => 2,
                    'name'  => 'test2@test.com',
                    'price' => 3393
                ],
            ]);

        $this->json('POST', '/api/vouchers/' . $voucher1->id . '/bind/products/' . $product2->id, [], $this->_headers)
            ->assertStatus(404);
    }

    public function testsProductsListIsSortedCorrectly()
    {
        factory(Product::class)->create([
            'name'          => 'test1@test.com',
            'price'         => 4242,
        ]);

        factory(Product::class)->create([
            'name'          => 'test2@test.com',
            'price'         => 42,
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
                    'price' => 4242
                ],
                [
                    'id'    => 2,
                    'name'  => 'test2@test.com',
                    'price' => 42
                ],
            ]);

        $this->json('GET', '/api/products', ['orderBy' => 'price', 'direction' => 'desc'], $this->_headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'name', 'price'],
            ])
            ->assertJson([
                [
                    'id'    => 1,
                    'name'  => 'test1@test.com',
                    'price' => 4242
                ],
                [
                    'id'    => 2,
                    'name'  => 'test2@test.com',
                    'price' => 42
                ],
            ]);

        $this->json('GET', '/api/products', ['orderBy' => 'name', 'direction' => 'asc'], $this->_headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'name', 'price'],
            ])
            ->assertJson([
                [
                    'id'    => 1,
                    'name'  => 'test1@test.com',
                    'price' => 4242
                ],
                [
                    'id'    => 2,
                    'name'  => 'test2@test.com',
                    'price' => 42
                ],
            ]);

        $this->json('GET', '/api/products', ['orderBy' => 'id', 'direction' => 'desc'], $this->_headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'name', 'price'],
            ])
            ->assertJson([
                [
                    'id'    => 2,
                    'name'  => 'test2@test.com',
                    'price' => 42
                ],
                [
                    'id'    => 1,
                    'name'  => 'test1@test.com',
                    'price' => 4242
                ],
            ]);
    }
}

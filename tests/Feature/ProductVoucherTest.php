<?php

namespace Tests\Feature;

use App\Product;
use App\ProductVoucher;
use App\User;
use App\Voucher;
use Tests\TestCase;

class ProductVoucherTest extends TestCase
{
    private $_headers = [];

    public function setUp()
    {
        parent::setUp();
        $user           = factory(User::class)->create();
        $token          = $user->generateToken();
        $this->_headers = ['Authorization' => "Bearer $token"];
    }

    public function testVoucherBindedToProductCorrectly()
    {
        $voucher = factory(Voucher::class)->create([
            'date_from' => date('Y-m-d H:i:s', strtotime('-1 days')),
            'date_till' => date('Y-m-d H:i:s', strtotime('+1 days')),
            'discount'  => 20
        ]);

        $product = factory(Product::class)->create([
            'name'          => 'test1@test.com',
            'price'         => 1000,
        ]);

        $this->json('POST', '/api/vouchers/' . $voucher->id . '/bind/products/' . $product->id, [], $this->_headers)
            ->assertStatus(200)
            ->assertJson([
                    'id'            => 1,
                    'product_id'    => 1,
                    'voucher_id'    => 1
            ]);
    }

    public function testVoucherUnBindedFromProductCorrectly()
    {
        $voucher = factory(Voucher::class)->create([
            'date_from' => date('Y-m-d H:i:s', strtotime('-1 days')),
            'date_till' => date('Y-m-d H:i:s', strtotime('+1 days')),
            'discount'  => 20
        ]);

        $product = factory(Product::class)->create([
            'name'          => 'test1@test.com',
            'price'         => 1000,
        ]);

        factory(ProductVoucher::class)->create([
            'product_id'    => 1,
            'voucher_id'    => 1
        ]);

        $this->json('DELETE', '/api/vouchers/' . $voucher->id . '/unbind/products/' . $product->id, [], $this->_headers)
            ->assertStatus(204);
    }
}

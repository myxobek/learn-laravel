<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VoucherTest extends TestCase
{
    private $_headers = [];

    public function setUp()
    {
        parent::setUp();
        $user           = factory(User::class)->create();
        $token          = $user->generateToken();
        $this->_headers = ['Authorization' => "Bearer $token"];
    }

    public function testsVoucherIsCreatedCorrectly()
    {
        $date_from = date('Y-m-d H:i:s', strtotime('-1 days'));
        $date_till = date('Y-m-d H:i:s', strtotime('+1 days'));

        $payload = [
            'date_from' => $date_from,
            'date_till' => $date_till,
            'discount'  => 42,
        ];

        $this->json('POST', '/api/vouchers', $payload, $this->_headers)
            ->assertStatus(200)
            ->assertJson([
                'id'        => 1,
                'date_from' => $date_from,
                'date_till' => $date_till,
                'discount'  => 42,
            ]);
    }
}

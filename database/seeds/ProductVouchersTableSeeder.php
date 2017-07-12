<?php

use Illuminate\Database\Seeder;

class ProductVouchersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ProductVoucher::truncate();

        $faker = \Faker\Factory::create();

        $products_ids = range(1,50);
        $vouchers_ids = range(1,10);

        for ($i = 0; $i < 25; $i++) {
            \App\ProductVoucher::create([
                'product_id' => $faker->randomElement($products_ids),
                'voucher_id' => $faker->randomElement($vouchers_ids)
            ]);
        }
    }
}

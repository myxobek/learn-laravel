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
        $memo         = [];

        for ($i = 0; $i < 25; $i++) {
            do
            {
                $product_id = $faker->randomElement($products_ids);
                $voucher_id = $faker->randomElement($vouchers_ids);
                $key        = $product_id . '_' . $voucher_id;
            } while( in_array($key, $memo) );
            $memo[] = $key;
            \App\ProductVoucher::create([
                'product_id' => $product_id,
                'voucher_id' => $voucher_id
            ]);
        }
    }
}

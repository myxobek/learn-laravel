<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Product::truncate();

        $faker = \Faker\Factory::create();

        $voucher_ids = [1,2,3,4,5,6,7,8,9,10];

        for ($i = 0; $i < 50; $i++) {
            \App\Product::create([
                'name'          => $faker->email,
                'price'         => $faker->randomFloat(0,0,1000),
                'vouchers_ids'  => json_encode( $faker->randomElements( $voucher_ids, rand(0,10) ) )
            ]);
        }
    }
}

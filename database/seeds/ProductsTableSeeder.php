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

        for ($i = 0; $i < 50; $i++) {
            \App\Product::create([
                'name'          => $faker->email,
                'price'         => $faker->randomFloat(0,0,1000),
            ]);
        }
    }
}

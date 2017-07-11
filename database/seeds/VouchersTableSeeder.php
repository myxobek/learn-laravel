<?php

use Illuminate\Database\Seeder;

class VouchersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Voucher::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            \App\Voucher::create([
                'date_from' => $faker->dateTimeBetween('-2 days', '-1 days'),
                'date_till' => $faker->dateTimeBetween('-1 days', '1 days'),
                'discount'  => $faker->numberBetween(1, 75)
            ]);
        }
    }
}

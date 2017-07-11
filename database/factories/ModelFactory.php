<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker)
{
    static $password;

    return [
        'name'              => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'password'          => $password ?: $password = bcrypt('secret'),
        'remember_token'    => str_random(10),
    ];
});

$factory->define(App\Voucher::class, function (Faker\Generator $faker)
{
    return [
        'date_from' => $faker->dateTimeBetween('-2 days', '-1 days'),
        'date_till' => $faker->dateTimeBetween('-1 days', '1 days'),
        'discount'  => $faker->numberBetween(1, 75)
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker)
{
    $voucher_ids = [1,2,3,4,5,6,7,8,9,10];
    return [
        'name'          => $faker->email,
        'price'         => $faker->randomFloat(0,0,1000),
        'vouchers_ids'  => json_encode( $faker->randomElements( $voucher_ids, rand(0,10) ) )
    ];
});

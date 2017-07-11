<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::truncate();

        $password = Hash::make('foobar123');

        User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@test.com',
            'password'  => $password,
        ]);
    }
}

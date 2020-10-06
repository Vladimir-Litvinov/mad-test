<?php

use App\Models\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => "admin@admin.com",
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            'role' => User::ROLE_ADMIN,
            'name' => "admin",
            'phone' => 123456,
        ]);
        DB::table('users')->insert([
            'email' => "vl.developer19@gmail.com",
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            'role' => User::ROLE_CLIENT,
            'name' => "client",
            'phone' => 123457,
        ]);
        DB::table('users')->insert([
            'email' => "detailer@detailer.com",
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            'role' => User::ROLE_DETAILER,
            'name' => "detailer",
            'phone' => 123458,
        ]);
    }
}

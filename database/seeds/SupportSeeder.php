<?php

use Illuminate\Database\Seeder;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('supports')->insert([
            'phone' => '111111112',
            'email' => 'test@test.com'
        ]);
    }
}

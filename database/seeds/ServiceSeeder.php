<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'title' => 'cleaning',
            'price' => '10',
        ]);

        DB::table('services')->insert([
            'title' => 'washing',
            'price' => '15',
        ]);

        DB::table('services')->insert([
            'title' => 'dust cleaning',
            'price' => '20',
        ]);

        DB::table('services')->insert([
            'title' => 'wheel check',
            'price' => '25',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'title' => 'Templates'
        ]);

        DB::table('categories')->insert([
            'title' => 'Car'
        ]);

        DB::table('categories')->insert([
            'title' => 'Track'
        ]);
    }
}

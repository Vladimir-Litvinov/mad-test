<?php

use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            'title' => 'Basic',
            'price' => 35,
            'category_id' => 2,
        ]);

        DB::table('package_services')->insert([
            'package_id' => 1,
            'service_id' => 2,
        ]);

        DB::table('package_services')->insert([
            'package_id' => 1,
            'service_id' => 3,
        ]);
    }
}

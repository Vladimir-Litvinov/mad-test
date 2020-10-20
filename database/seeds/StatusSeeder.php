<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'title' => 'Waiting for submissions'
        ]);
        DB::table('statuses')->insert([
            'title' => 'In progress'
        ]);
        DB::table('statuses')->insert([
            'title' => 'Upcoming'
        ]);
        DB::table('statuses')->insert([
            'title' => 'Not paid'
        ]);

        DB::table('statuses')->insert([
            'title' => 'Rejected'
        ]);

        DB::table('statuses')->insert([
            'title' => 'Application sent'
        ]);

        DB::table('statuses')->insert([
            'title' => 'Done'
        ]);
        DB::table('statuses')->insert([
            'title' => 'SAVED_TO_LATER'
        ]);
    }
}

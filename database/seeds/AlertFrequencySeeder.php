<?php

use Illuminate\Database\Seeder;

class AlertFrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alert_frequencies')->insert([
            ['name' => 'All Alerts'],
            ['name' => 'Hourly'],
            ['name' => 'Daily'],
        ]);
    }
}

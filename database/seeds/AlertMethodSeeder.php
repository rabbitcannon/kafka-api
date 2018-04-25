<?php

use Illuminate\Database\Seeder;

class AlertMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alert_methods')->insert([
            ['name' => 'Email'],
            ['name' => 'Push'],
            ['name' => 'SMS'],
        ]);
    }
}

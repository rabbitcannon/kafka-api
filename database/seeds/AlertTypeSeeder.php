<?php

use Illuminate\Database\Seeder;

class AlertTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alert_types')->insert([
            ['name' => 'Debug'],
            ['name' => 'Warning'],
            ['name' => 'Critical+'],
        ]);
    }
}

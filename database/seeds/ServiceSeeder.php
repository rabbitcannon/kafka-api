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
            ['name' => 'All Services'],
            ['name' => 'LENS'],
            ['name' => 'Wallet'],
            ['name' => 'Check Processor'],
            ['name' => 'PAM'],
        ]);
    }
}

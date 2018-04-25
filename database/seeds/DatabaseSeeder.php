<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AccountSeeder::class);
         $this->call(ServiceSeeder::class);
         $this->call(AlertTypeSeeder::class);
         $this->call(AlertFrequencySeeder::class);
         $this->call(AlertMethodSeeder::class);
    }
}

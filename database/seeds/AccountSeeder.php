<?php

use App\Profile;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'robert',
            'last_name' => 'blahut',
            'email' => 'anesthetikal@gmail.com',
            'password' => bcrypt('testpass'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Profile::create([
            'user_id' => $user->id,
            'phone' => '8652878407',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

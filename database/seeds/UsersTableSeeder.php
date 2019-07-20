<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'email' => 'bdraihan71@gmail.com',
            'f_name' => 'Raihan',
            'l_name' => 'Farhad',
            'gender' => 'male',
            'email_verified_at' => new DateTime,
            'password' => bcrypt('bangladesh'),
            'created_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'email' => 'vondo@gmail.com',
            'f_name' => 'Vondo',
            'l_name' => 'Khan',
            'gender' => 'female',
            'email_verified_at' => new DateTime,
            'password' => bcrypt('bangladesh'),
            'created_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'email' => 'other@gmail.com',
            'f_name' => 'other',
            'l_name' => 'Khan',
            'gender' => 'other',
            'email_verified_at' => new DateTime,
            'password' => bcrypt('bangladesh'),
            'created_at' => Carbon::now(),
        ]);
    }
}

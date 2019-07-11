<?php

use Illuminate\Database\Seeder;

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
            'email_verified_at' => new DateTime,
            'password' => bcrypt('bangladesh')
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'email' => 'vondo@gmail.com',
            'f_name' => 'Vondo',
            'l_name' => 'Khan',
            'email_verified_at' => new DateTime,
            'password' => bcrypt('bangladesh')
        ]);
    }
}

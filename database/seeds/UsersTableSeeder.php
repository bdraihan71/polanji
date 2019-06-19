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
            'email_verified_at' => new DateTime,
            'password' => bcrypt('bangladesh')
        ]);
    }
}

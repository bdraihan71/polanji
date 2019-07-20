<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'id' => 1,
            'body' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.',
            'user_id' => 1,
            'source' => 'web',
            'created_at' => Carbon::now(),
        ]);

        DB::table('posts')->insert([
            'id' => 2,
            'body' => 'Aenean commodo ligula eget dolor. Aenean massa. ',
            'user_id' => 1,
            'source' => 'web',
            'created_at' => Carbon::now(),
        ]);

        DB::table('posts')->insert([
            'id' => 3,
            'body' => ' Cum sociis natoque penatibus et magnis dis parturient montes,',
            'user_id' => 2,
            'source' => 'web',
            'created_at' => Carbon::now(),
        ]);
    }
}

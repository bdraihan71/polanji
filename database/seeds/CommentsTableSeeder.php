<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'id' => 1,
            'body' => 'Lorem ipsum dolor sit amet',
            'user_id' => 1,
            'source' => 'web',
            'post_id' => 1,
        ]);

        DB::table('comments')->insert([
            'id' => 2,
            'body' => ' consectetuer adipiscing elit.',
            'user_id' => 1,
            'source' => 'web',
            'post_id' => 2,
        ]);

        DB::table('comments')->insert([
            'id' => 3,
            'body' => 'Aenean commodo ligula eget dolor. ',
            'user_id' => 2,
            'source' => 'web',
            'post_id' => 1,
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('likes')->insert([
            'id' => 1,
            'type' => 'post',
            'user_id' => 1,
            'content_id' => 1
        ]);

        DB::table('likes')->insert([
            'id' => 2,
            'type' => 'comment',
            'user_id' => 1,
            'content_id' => 1
        ]);

        DB::table('likes')->insert([
            'id' => 3,
            'type' => 'reply',
            'user_id' => 1,
            'content_id' => 1
        ]);

        DB::table('likes')->insert([
            'id' => 4,
            'type' => 'post',
            'user_id' => 2,
            'content_id' => 1
        ]);

        DB::table('likes')->insert([
            'id' => 5,
            'type' => 'post',
            'user_id' => 2,
            'content_id' => 2
        ]);
    }
}

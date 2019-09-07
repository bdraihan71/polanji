<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostLikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_likes')->insert([
            'id' => 1,
            'user_id' => 1,
            'post_id' => 1,
            'is_liked' => true,
            'created_at' => Carbon::now(),
        ]);

        DB::table('post_likes')->insert([
            'id' => 2,
            'user_id' => 2,
            'post_id' => 1,
            'is_liked' => true,
            'created_at' => Carbon::now(),
        ]);

        DB::table('post_likes')->insert([
            'id' => 3,
            'user_id' => 1,
            'post_id' => 2,
            'is_liked' => true,
            'created_at' => Carbon::now(),
        ]);
    }
}

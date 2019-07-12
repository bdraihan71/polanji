<?php

use Illuminate\Database\Seeder;

class ReplyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('replies')->insert([
            'id' => 1,
            'body' => 'It was popularised in the 1960s with the release',
            'user_id' => 1,
            'source' => 'web',
            'post_id' => 1,
            'comment_id' => 1,
        ]);

        DB::table('replies')->insert([
            'id' => 2,
            'body' => 'Contrary to popular belief,',
            'user_id' => 1,
            'source' => 'web',
            'post_id' => 1,
            'comment_id' => 1,
        ]);
    }
}

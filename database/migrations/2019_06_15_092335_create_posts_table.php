<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('body');
            $table->bigInteger('user_id');
            $table->integer('category_id');
            $table->string('tag_id');
            $table->string('is_premium');
            $table->boolean('is_anonymous');
            $table->string('location_id');
            $table->enum('source', ['web', 'app']);
            $table->enum('status', ['approved', 'pending', 'spam', 'reject']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

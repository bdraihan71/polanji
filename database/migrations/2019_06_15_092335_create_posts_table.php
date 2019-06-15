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
            $table->integer('category_id')->nullable();
            $table->string('tag_id')->nullable();
            $table->integer('premium_id')->default(1);
            $table->boolean('is_anonymous')->default(false);
            $table->integer('location_id')->nullable();
            $table->enum('source', ['web', 'app']);
            $table->enum('status', ['approved', 'pending', 'spam', 'reject'])->default('approved');
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

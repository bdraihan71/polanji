<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('body');
            $table->bigInteger('user_id');
            $table->bigInteger('post_id');
            $table->bigInteger('comment_id');
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
        Schema::dropIfExists('replies');
    }
}

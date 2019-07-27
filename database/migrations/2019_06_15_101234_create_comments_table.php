<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->softDeletes();
            $table->longtext('body');
            $table->bigInteger('user_id');
            $table->bigInteger('post_id');
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
        Schema::dropIfExists('comments');
    }
}

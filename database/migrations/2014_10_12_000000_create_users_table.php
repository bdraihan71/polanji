<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone');
            $table->enum('source', ['web', 'app']);
            $table->integer('role')->default(1);
            $table->string('password');
            $table->string('is_premium');
            $table->date('birthday');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->enum('marital_status', ['Married', 'Single', 'No Marital Status']);
            $table->string('active');
            $table->string('session');
            $table->string('fb_id');
            $table->string('google_id');
            $table->string('twitter_id');
            $table->string('subscription');
            $table->string('warnings');
            $table->string('blocked');
            $table->string('registered');
            $table->string('track_download_id');
            $table->string('partner_id');
            $table->string('location_id');
            $table->string('device_id');
            $table->string('fcm_id');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

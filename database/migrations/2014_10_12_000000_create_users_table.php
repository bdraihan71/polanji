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
            $table->string('f_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->enum('source', ['web', 'app']);
            $table->integer('role_id')->default(1);
            $table->string('password')->nullable();
            $table->boolean('is_premium')->default(false);
            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->enum('marital_status', ['Married', 'Single', 'No Marital Status'])->nullable();
            $table->boolean('is_active')->default(false);
            $table->string('session')->default(false);
            $table->string('fb_id')->default(false);
            $table->string('google_id')->default(false);
            $table->string('twitter_id')->default(false);
            $table->integer('subscription_id')->default(1);
            $table->integer('warnings')->default(0);
            $table->boolean('is_blocked')->default(false);
            $table->integer('track_download_id')->nullable();
            $table->integer('partner_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('device_id')->nullable();
            $table->string('fcm_id')->nullable();
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

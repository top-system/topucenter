<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserPlatformTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('user_platform', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('platform_id',60)->comment('平台id');
            $table->string('platform_token')->comment('平台token');
            $table->string('type')->comment('facebook,google,wechat,qq,weibo,twitter');
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
        Schema::drop('user_platform');
    }
}

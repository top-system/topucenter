<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatereChargePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('recharge_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('套餐名称');
            $table->string('description')->comment('套餐描述');
            $table->decimal('amount')->comment('需要费用');
            $table->integer('value')->comment('金币/Vip到期天数');
            $table->tinyInteger('type')->default(0)->comment('0:储值，1:开通VIP');
            $table->tinyInteger('status')->comment('0:生效，1:暂停');
            $table->timestamp('expire_at')->comment('到期时间');
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
        Schema::drop('recharge_packages');
    }
}

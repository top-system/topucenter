<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('payment_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户id');
            $table->string('gateway')->comment('支付网关');
            $table->string('app_id')->comment('商户id');
            $table->string('channel')->comment('支付通道');
            $table->char('currency',3)->default('CNY')->comment('货币代码');
            $table->string('trade_no',64)->comment('流水号');
            $table->decimal('amount')->comment('充值金额');
            $table->tinyInteger('status')->comment('0:待支付，1:已支付，2:已取消');
            $table->string('description')->comment('订单描述');
            $table->string('request_ip',16)->comment('发起IP');
            $table->timestamps();
        });

        Schema::create('payment_order_extension', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户id');
            $table->string('app_id')->comment('商户id');
            $table->integer('payment_id')->comment('支付订单id');
            $table->text('request_body')->comment('请求消息体');
            $table->text('response_body')->comment('响应消息体');
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
        Schema::drop('payment_orders');
        Schema::drop('payment_order_extension');
    }
}

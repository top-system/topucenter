<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');         // user_id
            $table->decimal('coin');            // 币种
            $table->tinyInteger('type');        // 1:充值 2:提现 3:转账 4:收益 5:消费
            $table->decimal('amount');          // 金额
            $table->decimal('before_amount');   // 变动前金额
            $table->decimal('after_amount');    // 变动后金额
            $table->string('remark');           // 备注
            $table->timestamp('created_at',0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bills');
    }
}

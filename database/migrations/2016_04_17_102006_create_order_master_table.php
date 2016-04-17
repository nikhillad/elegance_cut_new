<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_master', function (Blueprint $table) {
            $table->increments('order_id');
            $table->integer('user_id');
            $table->integer('coupon_id');
            $table->float('price');
            $table->integer('qty');
            $table->string('size');
            $table->string('delivery_type',20)->default('prepaid');
            $table->date('delivery_date');
            $table->string('status',50);
            $table->string('txn_id',25);
            $table->timestamps();

            $table->index('user_id');
            $table->index('coupon_id');
            $table->index('price');
            $table->index('status');
            $table->index('txn_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_master');
    }
}

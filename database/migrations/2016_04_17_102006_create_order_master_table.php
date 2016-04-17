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
            $table->integer('price');
            $table->string('delivery_type',20)->default('prepaid');
            $table->date('delivery_date');
            $table->string('status',50);
            $table->timestamps();

            $table->index('user_id');
            $table->index('coupon_id');
            $table->index('price');
            $table->index('payment_status');
            $table->index('status');
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
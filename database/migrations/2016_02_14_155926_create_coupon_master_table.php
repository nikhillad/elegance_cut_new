<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_master', function (Blueprint $table) {
            $table->increments('coupon_id');
            $table->string('name',100);
            $table->string('desc',250)->nullable();
            $table->float('discount_percent');
            $table->integer('status')->default(1);
            $table->varchar('coupon_code',10);
            $table->timestamps();
            $table->index('discount_percent');
            $table->primary('coupon_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coupon_master');
    }
}

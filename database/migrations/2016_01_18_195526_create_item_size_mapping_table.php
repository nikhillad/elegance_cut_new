<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemSizeMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_size_master', function (Blueprint $table) {
            $table->increments('item_size_id');
            $table->integer('size_id');
            $table->integer('item_id')->unsigned();
            $table->integer('qty')->default(0);
            $table->foreign('item_id')->references('item_id')->on('item_master');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item_size_master');
    }
}

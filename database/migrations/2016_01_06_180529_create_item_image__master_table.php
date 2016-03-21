<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemImageMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_image_master', function (Blueprint $table) {
            $table->increments('item_image_id');
            $table->integer('item_id')->unsigned();
            $table->string('image',250);
            $table->string('image_type',100)->nullable();
            $table->string('asset_path')->nullable();
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
        Schema::drop('item_image_master');
    }
}

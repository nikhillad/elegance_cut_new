<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemImageMasterForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_image_master', function (Blueprint $table) {
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
        Schema::table('item_image_master', function (Blueprint $table) {
            $table->dropForeign('item_image_master_item_id_foreign');
        });
    }
}

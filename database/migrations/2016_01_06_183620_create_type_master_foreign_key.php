<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeMasterForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('type_master', function (Blueprint $table) {
            $table->foreign('category')->references('cat_id')->on('category_master');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('type_master', function (Blueprint $table) {
            $table->dropForeign('type_master_category_foreign');
        });
    }
}

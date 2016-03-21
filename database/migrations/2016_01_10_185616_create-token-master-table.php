<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_master', function (Blueprint $table) {
            $table->increments('token_id');
            $table->string('token',250);
            $table->datetime('expire_on');
            $table->integer('user_id')->unsigned;
            $table->timestamps();
            $table->index('token');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('token_master');
    }
}

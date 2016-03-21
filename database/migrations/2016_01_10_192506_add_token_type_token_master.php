<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTokenTypeTokenMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('token_master', function (Blueprint $table) {
            $table->string('token_type',50);
            $table->integer('status')->default(1); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('token_master', function (Blueprint $table) {
            $table->dropColumn('token_type');
            $table->dropColumn('status'); 
        });
    }
}

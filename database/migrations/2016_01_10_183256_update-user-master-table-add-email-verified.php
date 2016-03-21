<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserMasterTableAddEmailVerified extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_master', function (Blueprint $table) {
            $table->integer('email_verified')->default(0);
            $table->integer('mobile_verified')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_master', function (Blueprint $table) {
            $table->dropColumn('email_verified');
            $table->dropColumn('mobile_verified');
        });
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_master', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('fname',100);
            $table->string('lname',200);
            $table->string('email')->unique();
            $table->string('mobile',10);
            $table->string('zip_code',10);
            $table->text('address');
            $table->string('city',100);
            $table->string('state',50);
            $table->string('country',50);
            $table->integer('status',1)->default(1);
            $table->dateTime('last_login');
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
            $table->index('fname');
            $table->index('lname');
            $table->index('mobile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_master');
    }
}

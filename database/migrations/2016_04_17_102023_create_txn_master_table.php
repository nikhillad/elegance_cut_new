<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTxnMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('txn_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('txn_id',25);
            $table->integer('user_id');
            $table->string('consumer_email',100);
            $table->string('consumer_phone',20);
            $table->string('pg_id',50)->nullable();
            $table->float('amount');
            $table->string('status',50)->default('Initiated');
            $table->string('mode',50)->nullable();
            $table->text('error')->nullable();
            $table->string('bank_code',50)->nullable();
            $table->string('pg_type',50)->nullable();
            $table->string('bank_ref_no',100)->nullable();
            $table->timestamps();

            $table->unique('txn_id');
            $table->index('user_id');
            $table->index('consumer_email');
            $table->index('consumer_phone');
            $table->unique('pg_id');
            $table->index('amount');
            $table->index('status');
            $table->index('mode');
            $table->index('bank_code');
            $table->index('pg_type');
            $table->index('bank_ref_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('txn_master');
    }
}

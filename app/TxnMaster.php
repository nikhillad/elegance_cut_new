<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TxnMaster extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'txn_master';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'txn_id', 'user_id', 'consumer_email', 'consumer_phone', 'pg_id', 'amount', 'status','mode','error','bank_code','pg_type','bank_ref_no'
    ];

     /**
     * The primary key of the table.
     *
     * @var integer
     */
    protected $primaryKey = 'txn_id';
}

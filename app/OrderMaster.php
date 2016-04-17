<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMaster extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_master';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id','txn_id','user_id', 'coupon_id', 'price', 'delivery_type', 'delivery_date', 'status'
    ];

     /**
     * The primary key of the table.
     *
     * @var integer
     */
    protected $primaryKey = 'order_id';
}

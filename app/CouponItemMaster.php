<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponItemMaster extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'coupon_type_master';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coupon_type_id', 'coupon_id', 'type_id'
    ];

     /**
     * The primary key of the table.
     *
     * @var integer
     */
    protected $primaryKey = 'coupon_type_id';
}

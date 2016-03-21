<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponMaster extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'coupon_master';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coupon_id', 'name', 'desc', 'discount_percent', 'status', 'coupon_code'
    ];

     /**
     * The primary key of the table.
     *
     * @var integer
     */
    protected $primaryKey = 'coupon_id';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemSizeMaster extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_size_master';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'size_id','item_id','qty'
    ];

     /**
     * The primary key of the table.
     *
     * @var integer
     */
    protected $primaryKey = 'item_size_id';
}

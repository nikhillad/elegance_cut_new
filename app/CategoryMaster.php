<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryMaster extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category_master';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cat_id', 'name', 'cat_code',
    ];

     /**
     * The primary key of the table.
     *
     * @var integer
     */
    protected $primaryKey = 'cat_id';
}

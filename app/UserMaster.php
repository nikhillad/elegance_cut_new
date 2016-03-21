<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMaster extends Model
{
	 /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_master';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'mobile', 'zip_code', 'address', 'city', 'state', 'country', 'status', 'last_login', 'password',
    ];

     /**
     * The primary key of the table.
     *
     * @var integer
     */
    protected $primaryKey = 'user_id';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}

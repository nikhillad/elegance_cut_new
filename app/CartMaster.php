<?php

namespace App;

use Jenssegers\Mongodb\Model as Eloquent;

class CartMaster extends Eloquent
{
    protected $connection = 'mongodb';
    protected $table = 'cart';
}

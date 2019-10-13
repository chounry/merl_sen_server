<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    public $incrementing = false;
    protected $fillable = ['amount', 'p_id','created_date','user_id'];

}

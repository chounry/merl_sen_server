<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    //
    public function users(){
        return belongsToMany('App\Users', 'users', 'cart_id', 'user_id');
    }
}

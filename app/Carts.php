<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    //
    public function users(){
        return belongsToMany('App\Users', 'users', 'cart_id', 'user_id');
    }
}

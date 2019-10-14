<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function productImgs(){
        return $this->hasMany('App\ProductImgs','p_id');
    }

    public function categories(){
        return $this->belongsToMany('App\Categories','category_product','p_id','cat_id');
    }

    public function userCarts(){
        return $this->belongsToMany('App\Users','carts', 'p_id', 'user_id');
    }
}

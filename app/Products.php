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
}

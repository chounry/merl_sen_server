<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function products(){
        return $this->belongsToMany('App\Products','category_product','cat_id','p_id');
    }
}

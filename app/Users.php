<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Users extends Authenticatable
{
    use HasApiTokens, Notifiable;
    public $table = 'users';

    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['full_name','password','phone','profile_img','user_type_id','id','unit_sale_price'];

    public function carts(){
        return $this->belongsToMany('App\Products','carts','user_id','p_id')->withPivot('amount', 'created_date','id','unit_sale_price','bought');
    }

    public function findForPassport($username) {
        return $this->where('phone', $username)->first();
    }

    public function buyings(){
        return $this->belongsToMany('App\Carts', 'buyings', 'user_id', 'cart_id')->withPivot('address', 'phone','created_date','full_name');
    }
}

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
    protected $fillable = ['full_name','password','phone','profile_img','user_typ_id','id'];

    public function carts(){
        return $this->belongsToMany('App\Products','carts','user_id','p_id');
    }

    public function findForPassport($username) {
        return $this->where('phone', $username)->first();
    }
}

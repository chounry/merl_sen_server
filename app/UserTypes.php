<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTypes extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
}

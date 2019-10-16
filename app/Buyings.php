<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyings extends Model
{
    protected $table = 'buyings';
    //
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
}

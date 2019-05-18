<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Promotion extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','description','terms','image','start_date',
    'expirition_date','shop_id',];
}

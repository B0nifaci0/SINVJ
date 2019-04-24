<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Status extends Model
{
    //

    use SoftDeletes;

    protected $fillable =[
        'name'
    ];
}

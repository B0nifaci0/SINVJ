<?php

namespace App;

use App\sale;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Setting extends Model
{
    use softDeletes;

    protected $fillable = [

        'setting_id',
        

    ];
    
}

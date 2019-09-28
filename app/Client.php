<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'first_lastname',
        'second_lastname',
        'phone_number',
        'shop_id'
    ];
}

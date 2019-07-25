<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopGroup extends Model
{
    protected $fillable = [
        'name',
        'admin_id',
        'group_code',
        'password',
    ];
}

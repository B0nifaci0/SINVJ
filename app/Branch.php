<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use SoftDeletes;

    const FREE = '0';
    const PREMIUM = '1';

    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'phone_number',
        'shop_id',
        'state'
    ];

    public function shop()
    {
    	return $this->belongsTo(Shop::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}

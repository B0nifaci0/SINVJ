<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{

    // Tipos de suscripcion
    const shop_id = '';


    public  function scopeLast($query)
    {
        return $query->orderBy("id");
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'purchase_price',
        'sale_price',
        'discount_percentage',

    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

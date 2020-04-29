<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Authenticatable
{

    // Tipos de suscripcion
    const shop_id = '';


    public  function scopeLast($query)
    {
        return $query->orderBy("id");
    }
    use Notifiable;

    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'shop_id',
        'type_product',
        'shop_group_id'
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function shop_group()
    {
        return $this->belongsTo(ShopGroup::class);
    }
}

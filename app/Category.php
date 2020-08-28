<?php

namespace App;

use App\Shop;
use App\Product;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'shop_group_id',
        'business_rule_id'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function shop_group()
    {
        return $this->belongsTo(ShopGroup::class);
    }

    public function business_rule()
    {
        return $this->belongsTo(BusinessRule::class);
    }
}

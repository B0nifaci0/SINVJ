<?php

namespace App;

use App\Sale;
use App\Product;
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

    public function sales() {
        return $this->hasMany(Sale::class);
    }

    public function scopeItemsSold() {
        return Product::join('sale_details', 'sale_details.product_id', 'products.id')
            ->where('sale_id', $this->id)
            ->get();
    }
}

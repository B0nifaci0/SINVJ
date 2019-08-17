<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'final_price',
    ];
}

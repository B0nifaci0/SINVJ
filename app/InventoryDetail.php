<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class InventoryDetail extends Model
{

    protected $fillable = [
        'status_id',
        'inventory_report_id',
        'product_id',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}

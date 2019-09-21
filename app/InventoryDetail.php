<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class InventoryDetail extends Model
{

    const LOST = 1;
    const DISREPAIR = 2;

    protected $fillable = [
        'status',
        'inventory_report_id',
        'product_id',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}

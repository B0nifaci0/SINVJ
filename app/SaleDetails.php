<?php


namespace App;

use App\Sale;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleDetails extends Model
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'final_price',
        'profit'
    ];

    use SoftDeletes;

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

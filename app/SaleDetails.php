<?php
use App\Product;
namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'final_price',
        'profit'
    ];

    public function sale()
    {
      return $this->belongsTo(Sale::class);
    }
    public function product()
    {
      return $this->belongsTo(Product::class);
    }

}



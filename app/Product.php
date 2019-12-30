<?php

namespace App;
use App\TransferProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Branch;


class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'clave',
    	'description',
      'weigth',
      'observations',
      'price',
      'discount',
      'user_id',
    	'image',
      'category_id',
      'line_id',
      'shop_id',
      'branch_id',
      'discarded_product',
      'discar_cause',
      'price_purchase',
      'status_id'
    ];

    public function branch()
    {
      return $this->belongsTo(Branch::class);
    }

    public function shop()
    {
      return $this->belongsTo(Shop::class);
    }

    public function category(){
      return $this->belongsTo(Category::class);
    }
    
    public function line()
    {
      return $this->belongsTo(Line::class);
    }
    
    public function status()
    {
      return $this->belongsTo(Status::class);
    }
    public function sales()
    {
      return $this->belongsTo(Sale::class);
    }

    public function tranfer()
    {
      return $this->belongsTo(TransferProduct::class);
    }
    public function sale(){
      return $this->belongsTo(Sale::class);
    }
    
}

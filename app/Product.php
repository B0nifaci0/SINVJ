<?php

namespace App;

use App\Line;
use App\Sale;
use App\Shop;
use App\Branch;
use App\Status;
use App\Category;
use App\TransferProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    const SOLD  = 1; //Vendido
    const EXISTING = 2; //Existente
    const TRANSFER = 3; // Transferencia
    const DAMAGED = 4; //Dañado

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
        'restored_at',
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

    public function category()
    {
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

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}

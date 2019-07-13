<?php

namespace App;
use App\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class store_expenses extends Model
{
    use SoftDeletes;

        protected $fillable = [
          'name',
          'descripcion',
          'image',
          'price',
          'shop_id',
        ];
        
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}

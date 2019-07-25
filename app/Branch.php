<?php

namespace App;

use App\Shop;
use App\Product;
use App\TranferProducts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Branch extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'phone_number',
        'shop_id',
        'state'
    ];

    public function shop()
    {
    	return $this->belongsTo(Shop::class);
    }

    public function trans()
    {
        return $this->hasMany(TranferProducts::class);
    }

    public function transf()
    {
        return $this->hasMany(TrasferUser::class);
    }

    public function users(){
        return $this->hasMany(User::class);
      }
     


}

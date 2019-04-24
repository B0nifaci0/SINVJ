<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
    	'name',
    	'description',
    	'weigth',
    	'price',
    	'image',
    	'nationality',
    	'category_id',
        'shop_id',
        'status_id',
        'purity_id',
        'category_id',
    	'branch_id'
    ];

    public function branch()
    {
      return $this->belongsTo(Branch::class);
    }

    public function shop()
    {
      return $this->belongsTo(Shop::class);
    }
}

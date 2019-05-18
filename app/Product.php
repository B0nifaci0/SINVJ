<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Branch;


class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'name',
    	'description',
    	'weigth',
    	'purity',
    	'price',
    	'image',
    	'nationality',
    	'category_id',
    	'shop_id',
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

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
      'observations',
    	'price',
    	'image',
      'category_id',
      'line_id',
      'shop_id',
      'branch_id',
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
}

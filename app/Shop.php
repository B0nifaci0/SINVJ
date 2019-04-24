<?php

namespace App;
use App\Branch;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    //
    use SoftDeletes;    
    protected $fillable = [
        'name',
        'image',
        'description',
        'email',
        'phone_number',
        'user_id',
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function products()
    {
      return $this->hasMany(Product::class);
    }
}

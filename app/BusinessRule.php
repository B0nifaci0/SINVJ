<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class BusinessRule extends Model
{
    use softDeletes;

    protected $fillable = [
        'operator',
        'price',
        'discount_percentage',
        'shop_group_id',
        'shop_id',
    ];

    public function category()
    {
        return $this->hasMany(Category::class);
    }
    
}

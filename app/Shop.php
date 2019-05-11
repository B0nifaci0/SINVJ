<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'web_site',
        'description',
        'email',
        'phone_number',
        'schedules',
        'user_id',
        'municipality_id',
        'description'
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

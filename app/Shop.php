<?php

namespace App;
<<<<<<< HEAD
use App\User;
=======

>>>>>>> 9dae60bb5eb3499c15204c03f02fa027679fe342
use App\Branch;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

<<<<<<< HEAD
    public function users()
    {
      return $this->hasMany(User::class);
    }
=======
>>>>>>> 9dae60bb5eb3499c15204c03f02fa027679fe342
}

<?php

namespace App;

use App\Line;
use App\User;
use App\Branch;
use App\Status;
use App\Product;
use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'email',
        'password',
        'phone_number',
        'user_id',
        'municipality_id',
        'state_id',
        'description',
        'shop_group_id',
        'shop_code'
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function lines()
    {
        return $this->hasMany(Line::class);
    }
    public function statuss()
    {
        return $this->hasMany(Status::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function trans()
    {
        return $this->hasMany(TrasnferProduct::class);
    }
    public function expenses()
    {

        return $this->hasMany(Expense::class);
    }
    public function groups()
    {

        return $this->hasMany(ShopGroup::class);
    }

    public function inventories()
    {

        return $this->hasMany(InventoryReport::class);
    }
}

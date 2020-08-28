<?php

namespace App;

use App\Sale;
use App\Shop;
use App\User;
use App\Product;
use App\TrasferUser;
use App\TranferProducts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Branch extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'shop_id',
        'name_legal_re',
        'email',
        'other',
        'rfc',
    ];

    protected $hidden = [
        'password',
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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

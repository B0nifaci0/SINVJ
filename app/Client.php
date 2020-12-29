<?php

namespace App;

use App\Sale;
use App\Branch;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    const M = '1'; //mayorista
    const P = '0'; //publico
    protected $fillable = [
        'name',
        'first_lastname',
        'second_lastname',
        'type_client',
        'phone_number',
        'positive_balance',
        'shop_id',
        'branch_id',
        'credit',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->first_lastname} {$this->second_lastname} ";
    }
}

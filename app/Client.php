<?php

namespace App;

use App\Sale;
use App\Branch;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'first_lastname',
        'second_lastname',
        'phone_number',
        'shop_id',
        'branch_id'
    ];

    public function sales() {
        return $this->hasMany(Sale::class);
    }

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function getFullNameAttribute() {
        return "{$this->name} {$this->first_lastname} {$this->second_lastname} ";
    }
}

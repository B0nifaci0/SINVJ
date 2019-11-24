<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'concept',
        'amount',
        'user_id',
        'price',
        'shop_id',
        'branch_id',
        'name',
        'descripcion'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function branch()
    {
      return $this->belongsTo(Branch::class);
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}

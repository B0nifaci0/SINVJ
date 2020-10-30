<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{

    use SoftDeletes;

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



    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();;
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}

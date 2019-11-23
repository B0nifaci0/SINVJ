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
        'price'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function branch()
    {
      return $this->belongsTo(Branch::class);
    }
}

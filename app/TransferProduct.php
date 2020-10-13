<?php

namespace App;

use App\User;
use App\Branch;
use App\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TransferProduct extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'last_branch_id',
        'new_branch_id',
        'product_id',
        'destination_user_id',
        'status_product',
        'paid_at'
    ];

    protected $casts = [
        'updated_at'  => 'date:d-m-Y',
        'created_at' => 'date:d-m-Y',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function destinationUser()
    {
        return $this->belongsTo(User::class, 'destination_user_id')->withTrashed();
    }

    public function lastBranch()
    {
        return $this->belongsTo(Branch::class, 'last_branch_id');
    }

    public function newBranch()
    {
        return $this->belongsTo(Branch::class, 'new_branch_id');
    }

    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}

<?php

namespace App;
use App\Branch;
use App\Product;
use App\User;
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
          'status_product'
        ];

        public function product()
    {
      return $this->belongsTo(Product::class);
    }
    public function user()
    {
      return $this->belongsTo(User::class);
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

<?php

namespace App;

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
          'created_at',
          'destination_user_id'
        ];


        public function user()
    {
      return $this->belongsTo(ShoUserp::class);
    }

        public function product()
    {
      return $this->belongsTo(Product::class);
    }
}

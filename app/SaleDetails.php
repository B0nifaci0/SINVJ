<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'final_price',
    ];

<<<<<<< HEAD
=======
    public function sale()
    {
      return $this->belongsTo(Sale::class);
    }
>>>>>>> 7b9ea605bc7398b6c654f3c122983373019c4ec4
}



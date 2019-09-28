<?php

namespace App;

use App\InventoryDetail;
use Illuminate\Database\Eloquent\Model;

class InventoryReport extends Model
{
    protected $fillable = [
        'id',
        'start_date',
        'end_date',
    ];

    public function products() {
        return $this->hasMany(InventoryDetail::class);
    }
}

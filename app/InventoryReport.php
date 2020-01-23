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
        'status_report',
        'branch_id'
    ];

    public function products() {
        return $this->hasMany(InventoryDetail::class);
    }
}

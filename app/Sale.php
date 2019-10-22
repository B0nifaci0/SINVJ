<?php

namespace App;
use App\Product;
use App\Partial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{

   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_id',
        'customer_name',
        'telephone',
        'total',
        'client_id',
        'paid_out'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function line(){
        return $this->belongsTo(Line::class);
    }
    
    public function partial(){
        return $this->hasMany(Partial::class);
    }

     public function items() {
        return $this->hasMany(SaleDetails::class);
    }
    public function saledetail() {
        return $this->hasMany(SaleDetails::class);
    }

    public function partials() {
        return $this->hasMany(Partial::class);
    }

    public function scopeItemsSold() {
        return Product::join('sale_details', 'sale_details.product_id', 'products.id')
        ->where('sale_id', $this->id)
        ->get();
    }
}

 
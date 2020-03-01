<?php

namespace App;

use App\User;
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
        'user_id',
        'paid_out',
        'folio',
        'change',
        'income',
        'positive_balance',
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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeItemsSold() {
        return Product::join('sale_details', 'sale_details.product_id', 'products.id')
        ->join('categories', 'categories.id', 'products.category_id')
        ->select('products.id as id_product','clave', 'weigth','line_id', 'categories.name as category_name', 'sale_details.final_price','description')
        ->where('sale_id', $this->id)
        ->get();
    }

    public function scopeItemsGivedBack() {
        return Product::join('sale_details', 'sale_details.product_id', 'products.id')
        ->join('categories', 'categories.id', 'products.category_id')
        ->withTrashed()
        ->whereIn('products.discar_cause', [3,4])
        ->select('products.id as id_product','clave', 'weigth','line_id', 'categories.name as category_name', 'sale_details.final_price','description')
        ->where('sale_id', $this->id)
        ->get();
    }
    
}




<?php

namespace App;

use App\Line;
use App\User;
use App\Branch;
use App\Client;
use App\Partial;
use App\Product;
use App\SaleDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{

    use SoftDeletes;
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

    protected $casts = [
        'updated_at'  => 'date:d-m-Y',
        'created_at' => 'date:d-m-Y',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }

    public function line()
    {
        return $this->belongsTo(Line::class);
    }

    public function partial()
    {
        return $this->hasMany(Partial::class);
    }

    public function items()
    {
        return $this->hasMany(SaleDetails::class);
    }

    public function sale_detail()
    {
        return $this->hasMany(SaleDetails::class);
    }

    public function partials()
    {
        return $this->hasMany(Partial::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function scopeItemsSold()
    {
        return Product::join('sale_details', 'sale_details.product_id', 'products.id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->join('lines', 'lines.id', 'products.line_id')
            ->whereNull('sale_details.deleted_at')
            ->select('products.id as id_product', 'clave', 'weigth', 'line_id', 'categories.name as category_name', 'sale_details.final_price', 'description', 'sold_at', 'sale_details.deleted_at', 'lines.name as line_name')
            ->where('sale_id', $this->id)
            ->get();
    }

    public function scopeItemsGivedBack()
    {
        return Product::join('sale_details', 'sale_details.product_id', 'products.id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->withTrashed()
            ->whereNotNull('sale_details.deleted_at')
            // ->whereIn('products.discar_cause', [3, 4])
            ->select('products.id as id_product', 'clave', 'weigth', 'line_id', 'categories.name as category_name', 'sale_details.final_price', 'description', 'sold_at')
            ->where('sale_id', $this->id)
            ->get();
    }
}

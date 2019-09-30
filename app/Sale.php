<?php

namespace App;
use App\Product;
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
        'price',
        'client_id'
    ];

    public function client() {
      return $this->belongsTo(Client::class);
    }

  public function line(){
    return $this->belongsTo(Line::class);
  }
  public function parcial(){
    return $this->hasMany(Parcial::class);
  }

  public function items() {
    return $this->hasMany(SaleDetails::class);
  }
  public function saledetail() {
    return $this->hasMany(SaleDetails::class);
  }
}


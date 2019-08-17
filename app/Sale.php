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
        'customer_name',
        'telephone',
        'price'
    ];

  public function line(){
    return $this->belongsTo(Line::class);
  }
  public function parcial(){
    return $this->hasMany(Parcial::class);
  }

  public function items() {
    return $this->hasMany(SaleDetails::class);
  }
}


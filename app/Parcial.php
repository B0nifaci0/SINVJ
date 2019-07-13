<?php

namespace App;
use App\Sale;
use Illuminate\Database\Eloquent\Model;

class Parcial extends Model
{
  use SoftDeletes;

    protected $fillable = [
    'sale_id',
    'name',
    'parcial_pay',
    'total_pay'
    ];



public function sales()
    {
      return $this->belongsTo(Sale::class);
    }
  }
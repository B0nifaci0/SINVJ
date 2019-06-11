<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    // Tipos de suscripcion
    const shop_id = '';


    public  function scopeLast($query){
      return $query->orderBy("id");
    }
    

   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'folio_nota',
        
    ];
}

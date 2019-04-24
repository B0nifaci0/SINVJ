<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use Notifiable;

    use SoftDeletes;
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
        'name',
        'shop_id'
    ];

}

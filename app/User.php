<?php

namespace App;

use App\Shop;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{ 

  // Tipos de usuario
  const SELLER = '1';
  const BUYER = '0';
  const APP_ADMIN = '3';


  // Tipos de suscripcion
  const FREE = '0';
  const PREMIUM = '1';


  public  function scopeLast($query){
    return $query->orderBy("id");
  }
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name','email','type_user' ,'terms_conditions','suscription_type','password','deleted_at','shop_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function shop()
    {
      return $this->belongsTo(Shop::class);
    }
}

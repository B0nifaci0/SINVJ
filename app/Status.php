<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Authenticatable
{

    public  function scopeLast($query){
      return $query->orderBy("id");
    }
    use Notifiable;

   use SoftDeletes;
    /**
     * The attributes that  are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'shop_id',
    ];
    protected $table = 'statuss';

    public function shop(){
      return $this->belongsTo(Shop::class);
    }
}

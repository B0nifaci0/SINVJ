<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class store_expenses extends Model
{
    use SoftDeletes;
        protected $fillable = [
          'name',
          'descripcion',
          'img_reference',
          'price',
          'shop_id',
        ];
    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}

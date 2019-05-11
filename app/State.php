<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'id',
        'name'
      ];
    
      public function municipalites(){
        return $this->hasMany(municipality::class);
      }
}

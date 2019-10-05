<?php

namespace App;

use App\Client;
use App\Municipality;
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

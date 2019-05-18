<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\State;

class Municipality extends Model
{
  protected $fillable = [
    'id',
    'name'
  ];

  public function state(){
    return $this->belongsTo(State::class);
  }

}

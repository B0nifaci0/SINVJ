<?php

namespace App;
use App\Sale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partial extends Model
{
	// use SoftDeletes;

	public const CASH = '1';
	public const CARD = '2';

    protected $fillable = [
		'sale_id',
		'amount',
		'type',
    ];



	public function sales()
    {
    	return $this->belongsTo(Sale::class);
    }
}
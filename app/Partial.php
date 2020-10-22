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
	public const CREDIT = '3';

    protected $fillable = [
		'sale_id',
		'amount',
        'type',
        'image'
    ];



	public function sales()
    {
    	return $this->belongsTo(Sale::class);
    }
}

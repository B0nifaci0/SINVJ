<?php

namespace App;
use App\TranferProduct;
use App\Shop;
use App\Branch;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{

  // Tipos de usuario
  //AA = application administrator
  const AA = '1';
  // SA = sub administrator
  const SA = '2';
  // CO = collaborator
  const CO = '3';


  // Tipos de suscripcion
  const FREE = '0';
  const PREMIUM = '1';
  const PRO = '2';


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
		'name',
		'email',
		'type_user' ,'suscription_type',
		'password',
		'shop_id',
		'terms_conditions',
		'branch_id',
		'salary',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	public function shop()
	{
		return $this->belongsTo(Shop::class);
	}

	public function branch()
	{
		return $this->belongsTo(Branch::class);
	}

	public function trans()
	{
		return $this->hasMany(TransferProduct::class);
	}

}

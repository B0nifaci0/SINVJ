<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
  use SoftDeletes;

  protected $table = 'payments';

  protected $fillable = [
      'next_payment_date',
      'payment_method',
      'rode',
      'email',
      'reference_number',
      'card_reference',
      'user_id',
    ];

  public static function createFromPaypalResponse($payer, $user_id){
    echo "<pre>";
    print_r($payer);
    echo "</pre>";
      //$orderDate =(array) $payer->payer->payer_info->shipping_address;
      $orderDate = array();
      $orderDate["email"] = $payer->payer->payer_info->email;
      $orderDate['next_payment_date'] = Carbon::now()->addMonth();
      $orderDate['payment_method'] = $payer->payer->payment_method;
      $orderDate['rode'] = $payer->transactions[0]->amount->total;
      $orderDate['reference_number'] = 1;
      $orderDate['card_reference'] = $payer->cart;
      $orderDate['user_id'] = $user_id;
    return Payment::create($orderDate);
  }
}

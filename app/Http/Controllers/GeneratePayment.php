<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class GeneratePayment extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }
  public function index(){
    $user = Auth::user();

    return view('payment/makepaymet');
  }




}

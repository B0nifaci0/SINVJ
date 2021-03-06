<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StateController extends Controller
{	
	public function __construct()
    {
        $this->middleware('Authentication');
    }
	public function index()
	{
		return State::all();
	}

    public function show($id)
    {
    	$state = State::find($id);
    	return $state;
    }

    public function municipalities($id)
    {
    	///echo "dfsd";
    	$municipalities = Municipality::where('state_id', $id);
    	return $municipalities;
	}
	
	public function checkPassword(Request $request) {
		$shop = Auth::user()->shop;
		
		if(Hash::check($request->password, $shop->password)) {
			return response()->json([
				'success' => true
			], 200);
		}

		return response()->json([
			'success' => false
		], 401);
	}

	public function checkUser(Request $request) {
		$shop = Auth::user()->shop;
		
		if(Hash::check($request->password, $shop->password)) {
			return response()->json([
				'success' => true
			], 200);
		}

		return response()->json([
			'success' => false
		], 401);
	}

}

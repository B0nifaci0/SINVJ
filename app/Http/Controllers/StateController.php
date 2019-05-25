<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
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

}

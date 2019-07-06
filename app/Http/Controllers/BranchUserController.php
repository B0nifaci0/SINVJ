<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class BranchUserController extends Controller
{
	// Controlador de recursos anidados
    public function index($id)
    {
    	return User::where('branch_id', $id)->get();
    }
}
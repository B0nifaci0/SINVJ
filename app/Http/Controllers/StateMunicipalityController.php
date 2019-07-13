<?php

namespace App\Http\Controllers;

// Importar la definicion del modelo
use App\Municipality;
use Illuminate\Http\Request;

class StateMunicipalityController extends Controller
{
	// Controlador de recursos anidados
    public function index($id)
    {
    	return Municipality::where('state_id', $id)->get();
    }
}

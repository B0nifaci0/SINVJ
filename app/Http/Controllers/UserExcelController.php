<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests;

class UserExcelController extends Controller
{
  public function index()
{

      Excel::create('Usuarios Excel', function($excel) {

          $excel->sheet('Usuarios', function($sheet) {

              $users = User::all();

              $sheet->fromArray($users);

          });
      })->export('xls');

}
}

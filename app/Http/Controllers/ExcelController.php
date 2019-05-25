<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests;

class ExcelController extends Controller
{
  public function index()
{

      Excel::create('Laravel Excel', function($excel) {

          $excel->sheet('Productos', function($sheet) {

              $products = Product::all();

              $sheet->fromArray($products);

          });
      })->export('xls');

}
}

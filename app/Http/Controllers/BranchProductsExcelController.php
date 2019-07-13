<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests;
use App\Product;
use Illuminate\Support\Facades\DB;






class BranchProductsExcelController extends Controller
{
  public function index($id)
{
  //dd($id);
     Excel::create('Productos de Sucursal Excel', function($excel) use ($id) {

          $excel->sheet('Productos', function($sheet) use($id) {
            $branches=Product::where('branch_id','=',$id)->get();
              $sheet->fromArray($branches);
              //return $branches;
          });
      })->export('xls');
 }
}

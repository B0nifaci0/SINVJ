<?php

namespace App\Http\Controllers;

use App\Line;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\LineRequest;
use Illuminate\Support\Facades\Auth;
use App\Traits\S3ImageManager;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use  App\Exports\LinesExport;


class LineController extends Controller
{
    use S3ImageManager;

    public function __construct()
    {
        //$this->middleware('Authentication');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::User();

        $lines_shop = $user->shop->lines;
        if ($user->shop->shop_group_id) {
            $quantity = true;
            $products = $user->shop->products()
                ->where('products.status_id', 2);
            $categories = $products->with('category')
                ->get()
                ->pluck('category')
                ->unique()
                ->where('shop_id', $user->shop->id);

            $lines = $products->with('line')
                ->get()
                ->pluck('line')
                ->unique()
                ->where('shop_id', $user->shop->id);

            if (!$lines->count() && !$categories->count()) {
                $quantity = false;
            }
            $group = $user->shop->shop_group_id;
            $lines_group = Line::where('shop_group_id', $group)->get();
            return view('line/index', compact('lines_shop', 'lines_group', 'user', 'quantity'));
        }
        return view('line/index', compact('lines_shop', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::User();
        return view('line/add', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LineRequest $request)
    {
        $user = Auth::user();
        $line = new Line($request->all());
        if ($user->admin_group) {
            $line->shop_group_id = $user->shop->shop_group_id;
            $line->save();
            return redirect('/groupLines')->with('mesage', 'La linea se ha agregado exitosamente!');
        } else {
            $line->shop_id = $user->shop->id;
            $line->save();
            return redirect('/lineas')->with('mesage', 'La linea se ha agregado exitosamente!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('line.show', ['line' => Line::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $line = Line::findOrFail($id);
        //return $line;
        return view('line/edit', compact('line', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::User();
        $line = Line::findOrFail($id);
        $line->name = $request->name;
        $line->purchase_price = $request->purchase_price;
        $line->sale_price = $request->sale_price;
        $line->discount_percentage = $request->discount_percentage;
        $discount = $line->discount_percentage / 100;
        //return $line;
        $products = Product::where('line_id', $id)
            ->where('shop_id', $user->shop_id)
            ->get();
        //return $products;
        foreach ($products as $p) {
            $p->price = $line->sale_price * $p->weigth;
            $p->price_purchase = $line->purchase_price * $p->weigth;
            $percentage = $p->price * $discount;
            $p->discount = $p->price - $percentage;
            $p->save();
        }
        //return $products;
        //return $line;
        $line->save();
        return redirect('/lineas')->with('mesage-update', 'La Linea se ha modificado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exist = Product::where('line_id', $id)->get()->count();
        if ($exist > 0) {
            return response()->json([
                'success' => false
            ]);
        } else {
            Line::destroy($id);
            return response()->json([
                'success' => true
            ]);
        }

        //return redirect('/lineas')->with('mesage-delete', 'La Linea  se ha eliminado exitosamente!');
    }
    // Funcion para gener pdf!!
    public function exportPdf()
    {
        $date = date("Y-m-d");
        $hour = Carbon::now();
        $hour = date('H:i:s');
        $shop = Auth::user()->shop;
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $lines = Line::where('shop_id', NULL)
            ->orderBy('name', 'ASC')
            ->get();
        $pdf  = PDF::loadView('line.pdf', compact('lines', 'date', 'hour', 'shop'));
        return $pdf->stream('lineas.pdf');
    }

    // Funcion para gener excel!!
    public function exportExcel()
    {
        return Excel::stream(new LinesExport, 'line.xlsx');
    }
}

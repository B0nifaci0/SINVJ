<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Carbon\Carbon;
use PDF;

use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Support\Facades\Auth;
use App\Traits\S3ImageManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    use S3ImageManager;
    /*public function __construct(){
      $this->middleware('Authentication');
    }/*
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->shop->shop_group_id) {
            $group = $user->shop->shop_group_id;
            $categories_group = Category::where('shop_group_id', $group)->get();
            $categories_shop = $user->shop->categories;
            return view('category/index', compact('categories_shop', 'categories_group', 'user'));
        }
        $categories_shop = $user->shop->categories;
        return view('category/index', compact('categories_shop', 'user'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request  $request)
    {
        $user = Auth::user();
        return view('category/add', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        $user = Auth::user();
        $category = new Category($request->all());
        if ($user->admin_group) {
            $category->shop_group_id = $user->shop->shop_group_id;
            $category->save();
            return redirect('/groupCategories')->with('mesage', 'La categoria se ha agregado exitosamente!');
        } else {
            $category->shop_id = $user->shop->id;
            $category->save();
            return redirect('/categorias')->with('mesage', 'La categoria se ha agregado exitosamente!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('category.show', ['category' => Category::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $category = Category::findOrFail($id);
        //return $category;
        return view('category/edit', compact('category', 'user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->type_product = $request->type_product;
        $category->save();
        return redirect('/categorias')->with('mesage-update', 'La categoria se ha modificado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exist = Product::where('category_id', $id)->get()->count();
        //return $exist;
        if ($exist > 0) {
            return response()->json([
                'success' => false
            ]);
        } else {
            Category::destroy($id);
            return response()->json([
                'success' => true
            ]);
        }
    }
    public function exportPdf()
    {
        $date = date("Y-m-d");
        $hour = Carbon::now();
        $hour = date('H:i:s');
        $shop = Auth::user()->shop;
        if ($shop->image) {
            $shop->image = $this->getS3URL($shop->image);
        }
        $category = Category::where('shop_id', '=', NULL)
            ->where('type_product', 2)
            ->orderBy('name', 'ASC')
            ->get();

        $category2 = Category::where('shop_id', '=', NULL)
            ->where('type_product', 1)
            ->orderBy('name', 'ASC')
            ->get();

        $pdf  = PDF::loadView('category.pdf', compact('category', 'category2', 'date', 'hour', 'shop'));
        return $pdf->stream('categorias.pdf');
    }
}

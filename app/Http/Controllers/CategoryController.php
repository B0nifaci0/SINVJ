<?php

namespace App\Http\Controllers;

use App\Category;
use categories;
use Alert;
use App\User;
use App\Product;

use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    /*public function __construct(){
      $this->middleware('Authentication');
    }/*
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  // Codigo para determinar el tipo de usuario y la tienda a la que pertenece
        $user = Auth::user();
        /*return $users;
        $shop = Auth::user()->shop;
        return $shop; */   
        $categories = Auth::user()->shop->categories;
        //Lista el array de datos de categorias almacenados en la variable $categories
        //return $categories;
        return view('category/index', compact('categories','user'));
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
        //$name = $request->input("name");
        //return $name;
        //$category = Category::where('name')
        $category = new Category($request->all());
        $category->shop_id = Auth::user()->shop->id;
        $category->save();



        return redirect('/categorias')->with('mesage', 'la categoria se ha agregado exitosamente!');
   
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
      return view('category/edit', compact('category','user'));
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
      if($exist > 0){
        return response()->json([
          'success' => false
          ]);
        }else{
          Category::destroy($id);
           return response()->json([
          'success'=> true
          ]); 
    }
 }
}

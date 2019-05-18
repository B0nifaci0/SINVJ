<?php

namespace App\Http\Controllers;
use App\Promotion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PromotionValidate;


class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $promotions = Promotion::all();
    return view('promotions/index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('promotions/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromotionValidate $request)
    {
        if ($request->hasFile('image')){
        $filename = $request->image->getCLientOriginalName();
         $timestamp = time();
         $request->image->storeAs('public/upload/promotions',$timestamp .$filename);

         $promotion =  new Promotion($request->all());
         $promotion->image = $timestamp . $filename;
         $promotion->shop_id = Auth::user()->shop->id;
         $promotion->save();

    //return $promotion;
     return redirect('/promociones')->with('mesage', 'La promoción  se ha agregado exitosamente!');

     }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('promotions/show', ['promotion' => Promotion::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promotion = Promotion::find($id);
        return view('/promotions/edit',compact('promotion'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(PromotionValidate $request,  $id)
    {
          $promotion = Promotion::findOrFail($id);
        if ($request->hasFile('image')){
            // Borrar imagen anterior
          Storage::delete("public/upload/promotions/{$promotion->image}");
            $filename = $request->image->getCLientOriginalName();
            $timestamp = time();
         $request->image->storeAs('public/upload/promotions',$timestamp .$filename);
        $promotion->image = $timestamp . $filename;
        }
         $promotion->name = $request->name;
         $promotion->description = $request->description;
         $promotion->description = $request->description;
         $promotion->terms = $request->terms;
         $promotion->start_date = $request->start_date;
         $promotion->expirition_date = $request->expirition_date;

        $promotion->save();

      //return $request->all();
      return redirect('/promociones')->with('mesage-update', 'La promoción se ha actualizado  exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
          Storage::delete("public/upload/promotions/{$promotion->image}");
          $promotion->delete();
        // return redirect('/promociones')->with('mesage-delete', 'El producto se ha eliminado exitosamente!');
    }
}

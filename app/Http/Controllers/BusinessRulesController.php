<?php

namespace App\Http\Controllers;

use App\Line;
use App\User;
use App\Category;
use App\ShopGroup;
use App\BusinessRule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessRulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $rules_shop = BusinessRule::where('shop_id', $user->shop_id)
        ->get();
        //return $user->shop;
        //return $rules;
        
        if ($user->shop->shop_group_id) 
        {
            $group = $user->shop->shop_group_id;
            $rules_group = BusinessRule::where('shop_group_id', $group)
            ->get();
            //return $rules;
            return view('business_rules.index', compact('rules_group','rules_shop','user'));
        }

        return view('business_rules.index', compact('rules_shop','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('business_rules.add', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $user = Auth::user();
        
        if ($user->shop->shop_group_id)
        {
            $group = $user->shop->shop_group_id;
            $rules = BusinessRule::create([
                'operator' => $request->operator,
                'price' => $request->price,
                'discount_percentage' => $request->discount_percentage,
                'shop_group_id' => $group
            ]);
            return redirect('/groupBusinessrules')->with('mesage', 'Regla creada correctamente');
        } else {
            $rules = BusinessRule::create([
                'operator' => $request->operator,
                'price' => $request->price,
                'discount_percentage' => $request->discount_percentage,
                'shop_id' => $user->shop_id
            ]);
            return redirect('/businessrules')->with('mesage', 'Regla creada correctamente');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //return $request;
        $user = Auth::user();

        $rule = BusinessRule::find($id);
        $rule->operator = $request->operator;
        $rule->price = $request->price;
        $rule->discount_percentage = $request->discount_percentage;
        $rule->save();

        if ($user->shop->shop_group_id)
        {
            return redirect('/groupBusinessrules')->with('mesage-update', 'La regla ha sido actualizada exitosamente');
        } else {
            return redirect('/businessrules')->with('mesage-update', 'La regla ha sido actualizada exitosamente');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exist = Category::where('business_rule_id', $id)->get()->count();
        //return $exist;
        if ($exist > 0) {
            return response()->json([
                'success' => false
            ]);
        } else {
            BusinessRule::destroy($id);
            return response()->json([
                'success' => true
            ]);
        }
    }
}

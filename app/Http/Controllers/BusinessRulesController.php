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
        $categories = Category::where('shop_id', $user->shop_id)
        ->whereNull('business_rule_id')
        ->where('type_product',1)
        ->get();

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
            return view('business_rules.index', compact('categories', 'rules_group','rules_shop','user'));
        }

        foreach($rules_shop as $r)
        {
            $r->category = Category::where('business_rule_id',$r->id)
            ->select('id as category_id','name as category_name')
            ->get();
        }
        //return $rules;

        return view('business_rules.index', compact('categories','rules_shop','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->shop->shop_group_id) {
            $group = $user->shop->shop_group_id;
            $categories = Category::where('shop_group_id', $group)
            ->whereNull('business_rule_id')
            ->where('type_product',1)
            ->get();
            $lines = Line::where('shop_group_id', $group)->get();
        } else {
            $categories = Category::where('shop_id', $user->shop_id)
            ->whereNull('business_rule_id')
            ->where('type_product',1)
            ->get();
            $lines = $user->shop->lines;
        }
        return view('business_rules.add', compact('categories'));
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
        } else {
            $rules = BusinessRule::create([
                'operator' => $request->operator,
                'price' => $request->price,
                'discount_percentage' => $request->discount_percentage,
                'shop_id' => $user->shop_id
            ]);
        }
        if($request->category_id)
        {
            foreach($request->category_id as $category)
            {
                $categories = Category::find($category);
                $categories->business_rule_id = $rules->id;
                $categories->save();
            }
        }
        return redirect('/businessrules')->with('mesage', 'Regla creada correctamente');
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

        $categories = Category::where('business_rule_id',$id)
        ->get();
        
        foreach($categories as $c)
        {
            $c->business_rule_id = null;
            $c->save();
        }
        
        if($request->category_id)
        {
            foreach($request->category_id as $category)
            {
                $cat = Category::find($category);
                $cat->business_rule_id = $id;
                $cat->save();
            }
        }
        //return $categories;

        $rule = BusinessRule::find($id);
        $rule->operator = $request->operator;
        $rule->price = $request->price;
        $rule->discount_percentage = $request->discount_percentage;
        $rule->save();

        return redirect('/businessrules')->with('mesage-update', 'La regla ha sido actualizada exitosamente');

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

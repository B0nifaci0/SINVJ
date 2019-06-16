<?php

namespace App\Http\Controllers;

use App\User;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;




class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users=User::get();
      return view('User/index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $shops=Shop::all();
        return view('User/add', compact('shops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      \App\User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => bcrypt($request['password']),
        'type_user' => $request['type_user'],
        'shop_id' => $request['shop_id'],
        'terms_conditions' => $request['terms_conditions'],
    ]);


          return redirect('/usuarios')->with('mesage', 'El usuario  se ha agregado exitosamente!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
      $branches = Auth::user()->shop->branches;
      $users = User::find($id);
      if($users == 'NULL') {
      return redirect('/usuarios');
    }
      //return $users;
      return view('User/show',  compact('users','branches'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $users = User::findOrFail($id);
      $shops=Shop::all();

      //return $users;
      return view('User/edit', compact('users','shops'));
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      $users = User::findOrFail($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);

        $users->save();

        if ($users = false) {
           return view('User/edit', compact('users'));

        }else{
          $users=User::all();

            return redirect('/usuarios')->with('mesage-update', 'El usuario se ha modificado exitosamente!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      User::destroy($id);
   //return redirect('/usuarios')->with('mesage', 'El usuario  se ha desactivado exitosamente!');
    }
    //$branches = Auth::user()->shop->branches;

    public function soft($id){
      $users = User::withTrashed()
                ->where('id', $id)
                ->get();
                $user = $users[0];
                $user->deleted_at = NULL;
                $user->save();
      return $user;
      //return redirect('/usuarios')->with('mesage', 'El usuario  se ha activado exitosamente!');

    }
}

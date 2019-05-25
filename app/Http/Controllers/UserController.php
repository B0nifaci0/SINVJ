<?php

namespace App\Http\Controllers;

use App\User;
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
      $users=User::withTrashed()->get();
      //Sirve para la paginacion
      //$users=User::latest()->simplePaginate(1);
      //return $users;
      return view('users/index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        $user->save();


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
      return view('users/show',  compact('users','branches'));
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
      return $users;
      return view('users/edit', compact('users'));
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
        $users->username = $request->username;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->save();

        if ($user = false) {
            return view('users/edit', compact('users'));

        }else{
          $users=User::all();

            return view('users/index', ['users' => $users])->with('mesage-update', 'El usuario se ha modificado exitosamente!');

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

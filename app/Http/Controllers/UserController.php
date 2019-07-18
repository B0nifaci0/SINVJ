<?php

namespace App\Http\Controllers;

use App\User;
use App\Shop;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;




class UserController extends Controller
{
  public function __construct()
    {
        $this->middleware('Authentication');
        $this->middleware('BranchMiddleware');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //Consulta para obetener el usuario y la sucursal que tiene cada uno  $users=User::with('shop')->get();
      //Consulta para obtener los usuarios con referencia de la tienda a la que pertenecen
      //$users = Auth::user()->shop->users;
      $users = Auth::user()->shop->users;
     //$users = User::with('shop')->with('branch')->get(); //Consulta que se utiliza para poder acceder a los campos de cada modelo 
      //Consulta para obtener las sucursales con referencia de la tienda a la que pertenecen
      $branches=Auth::user()->shop->branches;
      //Comprobacion de datos
      //return $branches;
      //Comprobacion de datos
      //return $users;
      
      return view('User/index', compact('users','branches')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
       $user = Auth::user();
        // Consulta para obtener la tienda de acuerdo al usuario
        $shops=Auth::user()->shop()->get();
        //return $shops;
        // Consulta para obtener la sucursal de acuerdo a la tienda del usuario
        $branches=Auth::user()->shop->branches;
        //return $branches;
        return view('User/add', compact('shops','branches','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
      //$shops=Auth::user()->shop()->get();
      \App\User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => bcrypt($request['password']),
        'type_user' => $request['type_user'],
        'shop_id' => $request['shop_id'],
        'terms_conditions' => $request['terms_conditions'],
        'salary' => $request['salary'],
        'branch_id' => $request['branch_id'],
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
      $user = Auth::user();
      $users = User::findOrFail($id);
      //$user = Auth::user()->shop->branches;
      $shops=Auth::user()->shop()->get();
      $branches=Auth::user()->shop->branches;

      //return $users;
      return view('User/edit', compact('users','shops','branches','user'));
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request,$id)
    {
      $users = User::findOrFail($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);
        $users->branch_id = $request->branch_id;
        $users->type_user =$request->type_user;
        $users->salary =$request->salary;

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

<?php

namespace App\Http\Controllers;

use App\User;
use App\Shop;
use App\Branch;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
use Carbon\Carbon;



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
      $user = Auth::user();
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
      // sreturn $user;
      return view('User/index', compact('users','branches','user')); 
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
      if($users->type_user == 0){
        return redirect('/usuarios')->with('mesage-delete','El administrador no puede ser actualizado');
      }
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
    public function update(Request $request,$id)
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
    public function indexNomina(){
         $branch = Auth::user()->shop->id;
         $user = Auth::user();
         $branch = Shop::find($branch)->branches()->get();
        return view ('Payroll/nomina',compact('branch','user'));
    }

    public function nominasPdf( Request $request){

      $fech1 = Carbon::parse($request->fecini);
      $fech2 = Carbon::parse($request->fecter);
      $hoy = $fech1->diffInWeeks($fech2);
      $users = User::where("id","=",$request->user_id)->first();
      $salary = $users->salary;
      $nomina = ($hoy * $salary);


      $pdf  = PDF::loadView('User.NominasPDF', compact('users','nomina','hoy','fech1','fech2','salary'));
      // //$pdf->setPaper('a4', 'landscape'); Orientacion de los archivos pdf
      return $pdf->download('nominas.pdf');
    }

    public function indexReceipt(){
      $branch = Auth::user()->shop->id;
      $user = Auth::user();
      $branch = Shop::find($branch)->branches()->get();
     return view ('Payroll/recibo',compact('branch','user'));
    }

    public function receiptPDF(Request $request){
    
      $date = Carbon::now();
      $date = $date->format('d-m-Y');

      $users = User::where("id","=",$request->user_id)->get();
    
      $pdf  = PDF::loadView('Payroll.receipt', compact('users','date'));
      return $pdf->download('recibo.pdf');
    }

    public function receiptallPDF(){
    
      $users = Auth::user()->shop->users;

      $date = Carbon::now();
      $date = $date->format('d-m-Y');
    
      $pdf  = PDF::loadView('Payroll.receipall', compact('users','date'));
      return $pdf->download('recibos.pdf');
    }
}

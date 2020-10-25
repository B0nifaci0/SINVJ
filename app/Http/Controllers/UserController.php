<?php

namespace App\Http\Controllers;

use App\User;
use App\Shop;
use App\Branch;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
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
        return view('User/index');
    }

    public function serverSide()
    {
        $users = Auth::user()->shop->users()->with('branch:id,name')->get();
        return datatables()->of($users)->toJson();
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
        $shops = Auth::user()->shop()->get();
        //return $shops;
        // Consulta para obtener la sucursal de acuerdo a la tienda del usuario

        // BORRAR
        // if($user->shop->shop_group_id) {
        // $branches = Branch::where('shop_group_id', $user->shop->shop_group_id)
        // ->where('id', '!=', $user->branch->id)
        // ->get();
        // } else {
        // $branches = collect([]);
        // }

        $branches = Branch::where('shop_id', $user->shop->id)->get();

        //return $branches;
        return view('User/add', compact('shops', 'branches', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $password = $request->password;
        $passcon = $request->password_confirmation;

        if ($password != $passcon) {
            return redirect('/usuarios/create')->with('mesage-delete', 'Contraseñas diferentes, captura contraseñas iguales !');
        }
        $exist = User::where('email', $request->email)
            ->where('shop_id', Auth::User()->shop->id)
            ->first();
        if ($exist) {
            return redirect('/usuarios/create')->with('mesage-delete', 'El correo que intentas registrar ya existe');
        }
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
    public function show($id)
    {
        $branches = Auth::user()->shop->branches;
        $users = User::find($id);
        if ($users == 'NULL') {
            return redirect('/usuarios');
        }
        //return $users;
        return view('User/show',  compact('users', 'branches'));
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
        if ($users->type_user == 1) {
            return redirect('/usuarios')->with('mesage-delete', 'El administrador no puede ser actualizado');
        }
        //$user = Auth::user()->shop->branches;
        $shops = Auth::user()->shop()->get();
        $branches = Auth::user()->shop->branches;

        //return $users;
        return view('User/edit', compact('users', 'shops', 'branches', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $users = User::findOrFail($id);
        $exist = User::where('email', $request->email)
            ->where('shop_id', Auth::user()->shop->id)
            ->count();

        if ($exist == 1 && $request->email != $users->email) {
            return redirect('/usuarios/' . $id . '/edit')->with('mesage', 'El correo que intentas registrar ya existe');
        } else {
            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = bcrypt($request->password);
            $users->branch_id = $request->branch_id;
            $users->type_user = $request->type_user;
            $users->salary = $request->salary;

            $users->save();

            if ($users = false) {
                return view('User/edit', compact('users'));
            } else {
                $users = User::all();

                return redirect('/usuarios')->with('mesage-update', 'El usuario se ha modificado exitosamente!');
            }
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

    public function soft($id)
    {
        $users = User::withTrashed()
            ->where('id', $id)
            ->get();
        $user = $users[0];
        $user->deleted_at = NULL;
        $user->save();
        return $user;
        //return redirect('/usuarios')->with('mesage', 'El usuario  se ha activado exitosamente!');

    }
    public function indexNomina()
    {
        $branch = Auth::user()->shop->id;
        $user = Auth::user();
        $branch = Shop::find($branch)->branches()->get();
        return view('Payroll/nomina', compact('branch', 'user'));
    }

    public function nominasPdf(Request $request)
    {
        $hour = Carbon::now();
        $hour = date('H:i:s');

        $dates = Carbon::now();
        $dates = $dates->format('d-m-Y');


        $fech1 = Carbon::parse($request->fecini);
        $fech2 = Carbon::parse($request->fecter);
        $hoy = $fech1->diffInWeeks($fech2);
        $users = User::where("id", "=", $request->user_id)->first();
        $salary = $users->salary;
        $nomina = ($hoy * $salary);


        $pdf  = PDF::loadView('User.NominasPDF', compact('users', 'nomina', 'hoy', 'fech1', 'fech2', 'salary', 'hour', 'dates'));
        // //$pdf->setPaper('a4', 'landscape'); Orientacion de los archivos pdf
        return $pdf->stream('nominas.pdf');
    }

    public function indexReceipt()
    {

        $branch = Auth::user()->shop->id;
        $user = Auth::user();

        $branch = Shop::find($branch)->branches()->get();
        if (!$branch) {
            return redirect('/sucursales/create')->with('mesage', 'Primero debes crear una Sucursal!');
        }


        return view('Payroll/recibo', compact('branch', 'user'));
    }

    public function receiptPDF(Request $request)
    {

        $date = Carbon::now();
        $date = $date->format('d-m-Y');

        $users = User::where("id", "=", $request->user_id)->get();

        $pdf  = PDF::loadView('Payroll.receipt', compact('users', 'date'));
        return $pdf->stream('recibo.pdf');
    }

    public function receiptallPDF()
    {

        $users = Auth::user()->shop->users;

        $date = Carbon::now();
        $date = $date->format('d-m-Y');

        $pdf  = PDF::loadView('Payroll.receipall', compact('users', 'date'));
        return $pdf->stream('recibos.pdf');
    }
}

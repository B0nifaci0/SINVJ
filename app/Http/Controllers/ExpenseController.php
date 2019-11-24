<?php


namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Support\Facades\Auth;

// BORRAR
class ExpenseController extends Controller {

    public function index() {
        $user_ids = Auth::user()->shop->users;
        $expenses = Expense::whereIn('id', $user_ids)->with('user')->get();
        return view('expenses.index', compact('expenses'));
    }

}
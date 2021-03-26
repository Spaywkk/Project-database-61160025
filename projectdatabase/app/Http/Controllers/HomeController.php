<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = DB::table('products')
        ->select('*')
        ->join('users', 'users.id', '=', 'products.UserProduct_id')
        ->where('products.ProductStatus' , '=', 'on')
        ->orderBy('ProductID', 'DESC')
        ->get();


        return view('home', compact('products'));
    }
}

<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class BackPackController extends Controller
{
    public function index($id){

        // echo $id;

        // $trading_histories = DB::table('products')->where('UserProduct_id','=',$idu)->get();
        // return view('youhistorybackpack.index', compact('trading_histories'));

        $trading_histories = DB::table('trading_histories')
        ->join('orders', 'orders.OrderID', '=', 'trading_histories.OderID')
        ->join('order_details', 'order_details.OderdetailID', '=', 'trading_histories.OderdetailID')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->join('products', 'products.ProductID', '=', 'order_details.Product_ID')
        ->where('orders.user_id','=',$id)
        ->get();
        return view('youhistorybackpack.index', compact('trading_histories'));
    }

    public function ChangeBonus($id){

        $users = DB::table('users')
                    ->select('*')
                    ->where('id','=',$id)
                    ->get();

        return view('youhistorybackpack.changeBonus', compact('users'));

    }

    public function ConfirmChangeBonus(Request $request){


        DB::beginTransaction();

        try{

            DB::select('call ChangeBonus(?,?)',array($request->iduser, $request->AmountBonus));

        } catch(ValidationException $e) {

            DB::rollback();
        }
        DB::commit();

        return redirect('home');
        

    }

    
}

<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Dotenv\Exception\ValidationException;

class RankController extends Controller
{
    public function index($idu){

        $users = DB::table('users')->where('id','=',$idu)->get();
        return view('rank.index', compact('users'));
    }

    public function BuyRank(Request $request){


        DB::beginTransaction();

        try{
            
            DB::select('call BuyRank(?,?)',array($request->iduser,$request->rankbuy));

        } catch(ValidationException $e) {

            DB::rollback();
        }
        DB::commit();

        return redirect('home');

       
    }


}

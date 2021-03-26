<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Dotenv\Exception\ValidationException;

class ProductsController extends Controller
{
    public function index($idu){

        $products = DB::table('products')->where('UserProduct_id','=',$idu)->get();
        return view('products.index', compact('products'));
    
    }

    public function EditPostView($id){

        $productsedit = DB::table('products')->where('ProductID','=',$id)->get();
        return view('products.editpost', compact('productsedit'));
    
    }
    public function EditPostViewUpdate(Request $request){

        DB::beginTransaction();

        try{
 
                DB::table('products')->where('ProductID','=',$request->ProductID)->update([

                    'ProductTitle' => $request->ProductTitle,
                    'ProductType' => $request->ProductType,
                    'ProductDescriptions' => $request->ProductDescriptions,
                    'Price' => $request->Price,
                    'ProductStatus' => $request->ProductStatus,
                
                ]);

        } catch(ValidationException $e) {

            DB::rollback();
        }
        DB::commit();

        return redirect('home');


    
    }
    
    public function CreateProduct($idu){

        return view('products.create',compact('idu'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'UserProduct_id' => 'required',
            'ProductTitle' => 'required',
            'ProductType' => 'required',
            'ProductDescriptions' => 'required',
            'Price' => 'required',
            'ProductStatus' => 'required',
            'ImageSource' => 'required',
        ]);
        
        DB::table('products')->insert([

            'UserProduct_id' => $request->UserProduct_id,
            'ProductTitle' => $request->ProductTitle,
            'ProductType' => $request->ProductType,
            'ProductDescriptions' => $request->ProductDescriptions,
            'Price' => $request->Price,
            'ProductStatus' => $request->ProductStatus,
            'ImageSource' => $request->ImageSource,
            'created_at' =>now(),
        ]);
        return redirect('home');
    }


    public function Deposit($id)
    {   
        $users = DB::table('users')->where('id','=',$id)->get();
        return view('products.deposit', compact('users'));
    }

    public function InsertDeposits(Request $request,$id)
    {

        DB::beginTransaction();

        try{

            DB::statement("Update users SET Balance=Balance+".$request->Amount." where id=".$id);

        } catch(ValidationException $e) {

            DB::rollback();
        }
        DB::commit();

        return redirect('home');
        
    }


    public function BuyBeatIndex($id){

        $productsbuy = DB::table('products')
                        ->select('*')
                        ->join('users', 'users.id', '=', 'products.UserProduct_id')
                        ->where('products.ProductID' , '=',$id )
                        ->get();
        return view('products.buybeat', compact('productsbuy'));


    }

    public function BuyBeat(Request $request,$idp)
    {

        DB::beginTransaction();

        try{

            DB::select('call BuyProductBeat(?,?,?,?)',array($request->userbuy,$idp,$request->Price,now()));

        } catch(ValidationException $e) {

            DB::rollback();
        }
        DB::commit();

        return redirect('home');
        

       
        
    }

    public function SetSoldOutProduct($id)
    {

        DB::beginTransaction();

        try{

            DB::select('call SoldOutProduct(?)',array($id));

        } catch(ValidationException $e) {

            DB::rollback();
        }
        DB::commit();

        return redirect('home');
        
    }

}

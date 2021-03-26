<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RankController;

use App\Http\Controllers\BackPackController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/products/{idu}',[ProductsController::class,'index'])->name('products.index');
Route::get('/products/create/{id}',[ProductsController::class,'CreateProduct'])->name('products.createproduct');
Route::post('/products/store',[ProductsController::class,'store'])->name('products.store');
Route::get('/products/deposit/{idu}',[ProductsController::class,'Deposit'])->name('products.deposit');
Route::post('/products/deposit/insertdeposit/{id}',[ProductsController::class,'InsertDeposits'])->name('products.insertdeposit');

Route::get('/products/BuyBeatIndex/{id}',[ProductsController::class,'BuyBeatIndex'])->name('products.buybeatindex');
Route::post('/products/BuyBeatIndex/buybeat/{idp}',[ProductsController::class,'BuyBeat'])->name('products.buybeat');

Route::get('/products/editpostview/{id}',[ProductsController::class,'EditPostView'])->name('products.editpostview');
Route::post('/products/editpostview/editpostviewupdate',[ProductsController::class,'EditPostViewUpdate'])->name('products.editpostviewupdate');

Route::get('/products/setsoldout/{id}',[ProductsController::class,'SetSoldOutProduct'])->name('products.setsoldout');



#BackPackController----------
Route::get('/youhistorybackpack/{id}',[BackPackController::class,'index'])->name('backpack.index');
Route::get('/youhistorybackpack/changebonus/{id}',[BackPackController::class,'ChangeBonus'])->name('backpack.changebonus');
Route::post('/youhistorybackpack/changebonus',[BackPackController::class,'ConfirmChangeBonus'])->name('backpack.confirmchangebonus');


#RankController--------
Route::get('/rank/{id}',[RankController::class,'index'])->name('rank.index');
Route::post('/rank/buyrank',[RankController::class,'BuyRank'])->name('rank.buyrank');


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');











/*ตัวอยาง
// Route::get('/test/{name}', function ($name) {
//     echo $name;
// });


Route::get('/about','AboutController@index'); นี้คือแบบเก่า
ต้องสั่ง use App\Http\Controllers\AboutController; ไม่งั้นไม่รู้จัก
Route::get('/about',[AboutController::class, 'index ชื่อ fuction']);







*/

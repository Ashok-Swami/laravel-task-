<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\Task2;
use Illuminate\Support\Facades\Route;

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

// Route::get('/create', function () {
//     return view('create');
// });
// Route::get('/',[ProductController::class,'index']);
// Route::post('/',[ProductController::class,'']);
Route::get('/',[ProductController::class,'index']);
Route::get('/task2',[Task2::class,'index']);
Route::resource('/','App\Http\Controllers\ProductController');


Route::get('/create',function(){
return view('create');
});

Route::post('/post',[ProductController::class,'store']);
Route::get('/view/{id}',[ProductController::class,'show']);
Route::delete('/delete/{id}',[ProductController::class,'destroy']);
Route::get('/edit/{id}',[ProductController::class,'edit']);
Route::delete('/deleteimage/{id}',[ProductController::class,'deleteimage']);
Route::put('/update/{id}',[ProductController::class,'update']);

<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/', [HomeController::class, 'index']);

Route::group(["prefix" => "admin","namespace"=>"admin", 'as' => 'admin.'], function() {
  Route::get('/', [AdminController::class, 'index']);
  Route::post('/verifylogin', [AdminController::class, 'verifyLogin'])->name('verifylogin');
}); 
   
//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

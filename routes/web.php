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
  Route::get('/', [AdminController::class, 'index'])->name('login');
  Route::post('/verifylogin', [AdminController::class, 'verifyLogin'])->name('verifylogin');
  Route::get('/register', [AdminController::class, 'register'])->name('register');
  Route::post('/register', [AdminController::class, 'postRegister'])->name('register.post');
  Route::group(['middleware' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboardView'])->name('dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
  });
}); 
   
//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

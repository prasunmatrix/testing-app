<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CmsManageController;
use App\Http\Controllers\admin\PhotoGalleryController;
use App\Http\Controllers\admin\SettingsController;
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
    Route::get('/change-password', [AdminController::class, 'showChangePasswordForm'])->name('changePassword');
    Route::post('/change-password', [AdminController::class, 'changePassword'])->name('changePassword');
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/add-category', [CategoryController::class, 'create'])->name('add-category');
    Route::post('/add-category', [CategoryController::class, 'store'])->name('add-category.post');
    Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit'])->name('edit-category');
    Route::put('/update-category/{category_id}', [CategoryController::class, 'update'])->name('update.put');
    Route::get('/delete-category/{category_id}', [CategoryController::class, 'delete'])->name('delete');
    Route::get('/cms', [CmsManageController::class, 'index'])->name('cmslist');
    Route::get('/add-cms', [CmsManageController::class, 'create'])->name('add-cms');
    Route::post('/add-cms', [CmsManageController::class, 'store'])->name('add-cms.post');
    Route::get('/edit-cms/{cms_id}', [CmsManageController::class, 'edit'])->name('edit-cms');
    Route::put('/update-cms/{cms_id}', [CmsManageController::class, 'update'])->name('update.cms');
    Route::get('/delete-cms/{cms_id}', [CmsManageController::class, 'delete'])->name('delete');
    Route::get('/photogallery', [PhotoGalleryController::class, 'index'])->name('photogallerylist');
    Route::get('/add-photogallery', [PhotoGalleryController::class, 'create'])->name('add-photogallery');
    Route::post('/add-photogallery', [PhotoGalleryController::class, 'store'])->name('add-photogallery.post');
    Route::get('/edit-photogallery/{photogallery_id}', [PhotoGalleryController::class, 'edit'])->name('edit-photogallery');
    Route::put('/update-photogallery/{photogallery_id}', [PhotoGalleryController::class, 'update'])->name('update.photogallery');
    Route::post('/gallery-image-delete', [PhotoGalleryController::class, 'galleryImageDelete'])->name('gallery_image_delete');
    Route::get('/delete-photogallery/{photogallery_id}', [PhotoGalleryController::class, 'delete'])->name('delete');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'postSettings'])->name('post-settings');
    Route::post('/settings-social', [SettingsController::class, 'postSettingsSocial'])->name('post-settings-social');
  });
}); 
   
//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

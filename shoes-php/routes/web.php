<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CategoryController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;

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
Route::group(['middleware'=>'auth'],function(){
    Route::get('/index-product',[App\Http\Controllers\Backend\AdminController::class, 'index_product'])->name('index_product');
    Route::get('/add-product',[App\Http\Controllers\Backend\AdminController::class, 'add_product'])->name('add_product');
    Route::get('/pay',[App\Http\Controllers\Frontend\CartController::class, 'pay'])->name('frontend.cart.pay');

});


Route::group(['namespace'=>'Frontend'], function(){
    Route::get('/',[ProductController::class, 'index'])->name('frontend.home');
    Route::get('/category/{id}', [ProductController::class, 'show'])->name('frontend.category.show');
    Route::get('/productdetail/{id}', [ProductController::class,'productDetail'])->name('frontend.productdetail');
    Route::post('/cart/{id}', [App\Http\Controllers\Frontend\CartController::class,'add'])->name('frontend.cart.add');
    Route::get('/viewcart', [App\Http\Controllers\Frontend\CartController::class, 'viewcart'])->name('frontend.cart.view');
    Route::get('/delete/{id}', [App\Http\Controllers\Frontend\CartController::class, 'remove'])->name('frontend.cart.remove');
    Route::get('/increase/{id}',[App\Http\Controllers\Frontend\CartController::class, 'increaseQty'])->name('frontend.cart.increase');
    Route::get('/decrease/{id}',[App\Http\Controllers\Frontend\CartController::class, 'decreaseQty'])->name('frontend.cart.decrease');
    Route::post('/confirm-pay',[App\Http\Controllers\Frontend\CartController::class, 'confirm_pay'])->name('frontend.cart.confirm_pay');
    Route::get('/send',[App\Http\Controllers\Frontend\CartController::class, 'send'])->name('frontend.cart.send');
    Route::get('/user',[App\Http\Controllers\Frontend\UserController::class, 'index'])->name('frontend.user')->middleware('auth');
    Route::post('/user/update',[App\Http\Controllers\Frontend\UserController::class, 'update_user'])->name('frontend.user.update')->middleware('auth');
  
});

Route::group(['namespace'=>'Auth'], function(){
    Route::get('/auth/login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('/auth/postlogin', [LoginController::class,'postLogin'])->name('admin.postlogin');
    Route::get('/auth/logout', [LoginController::class,'logout'])->name('admin.logout');
    Route::get('/auth/register', [App\Http\Controllers\Auth\RegisterController::class,'getRegister'])->name('getRegister');
    Route::post('/Register',[App\Http\Controllers\Auth\RegisterController::class,'register'])->name('Register');
    Route::get('/change-password', [App\Http\Controllers\Auth\ChangePasswordController::class,'index'])->name('changepassword')->middleware('auth');
    Route::post('/post-password', [App\Http\Controllers\Auth\ChangePasswordController::class,'changePassword'])->name('postChange')->middleware('auth');
    
});
Auth::routes();

Route::get('/verify', [App\Http\Controllers\Auth\RegisterController::class,'verify'])->name('verify.user');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

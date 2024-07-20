<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPassword;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VerifikasiEmail;
use App\Http\Controllers\PertanyaanController;

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
    return view('pages.user.home',$data=['title'=>'Home']);
})->middleware('auth')->name('home');


//bagian pelanggan
Route::get('/home', function () {
    return view('pages.user.home',$data=['title'=>'Home']);
})->middleware('auth')->name('home');

Route::prefix('user')->group(function () {
    Route::get('/profil/{username}',[UserController::class,'show'])->middleware('auth');
    Route::get('/verifikasiEmail/{username}',[VerifikasiEmail::class,'verifiedMail'])->middleware('auth');
    Route::get('/verifikasiEmail',[VerifikasiEmail::class,'index'])->middleware('auth');
    Route::get('/signin',[AuthController::class,'index'])->middleware('guest')->name('login');
    Route::post('/signin',[AuthController::class,'authenticate']);
    Route::get('/signup',[AuthController::class,'create'])->middleware('guest');
    Route::post('/signup',[AuthController::class,'store']);
    Route::post('/signout',[AuthController::class,'logout'])->middleware('auth');    
    Route::get('/forgotpassword',[ForgotPassword::class,'index']);
    Route::post('/forgotpassword',[ForgotPassword::class,'reset']);        
    Route::delete('/delete/{username}',[UserController::class,'destroy'])->middleware('auth');  
});
Route::get('/edit/{section}/{username}',[UserController::class,'edit'])->middleware('verifiedMail');
Route::put('/edit/{section}/{username}',[UserController::class,'update'])->middleware('verifiedMail');
Route::get('/email/verifikasi/{username}',[VerifikasiEmail::class,'verifikasi'])->middleware('verifiedMail');




// CRUD UNTUK KATEGORI {/category}
Route::resource('/category', CategoryController::class)->middleware('auth');


// CRUD UNTUK PERTANYAAN {/pertanyaan}
Route::resource('/pertanyaan', PertanyaanController::class)->middleware('auth');;
Route::get('/pertanyaan/{id}/edit', [PertanyaanController::class,'edit'])->middleware('auth');;
Route::put('/pertanyaan/{id}/edit', [PertanyaanController::class,'update'])->middleware('auth');;





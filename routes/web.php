<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Auth::routes(); 

// Standard routes had to include specific pofiles-store
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//profiles
// Route::get('/create-profile', [App\Http\Controllers\ProfileController::class, 'create'] );
Route::post('/profiles-store' ,[App\Http\Controllers\ProfileController::class, 'store'] ); 
Route::resource('profiles', App\Http\Controllers\ProfileController::class);

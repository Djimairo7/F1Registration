<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
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

Route::get('/discover', [App\Http\Controllers\DiscoverController::class, 'index'])->name('discover');
Route::get('/race/{raceName}', 'App\Http\Controllers\RaceController@show')->name('race.show');
Route::post('/race/{raceName}/submit', 'App\Http\Controllers\RaceController@submitScore')->name('race.submit');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::post('/profiles', 'profilescontroller@store')->name('profiles.store');
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::delete('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');



// add aan het einde van de register routes later
// ->middleware('guest');
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RaceController;
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
Auth::routes();

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/discover', [App\Http\Controllers\DiscoverController::class, 'index'])->name('discover');

Route::delete('/notification/{id}', [NotificationController::class, 'destroy'])->name('notification.destroy');

Route::get('/race/{raceName}', [RaceController::class, 'show'])->name('race.show');
Route::post('/race/{raceName}/submit', [RaceController::class, 'submitScore'])->name('race.submit');

//route om profile.create.blade to connecten aan een web eindpunt met een authetificatie zodat je alleen een profiel kan maken als je ingelogt bent.
Route::get('/profile', [ProfileController::class, 'index'])->name('profile')
    ->middleware('auth');
Route::get('/profile/{user_id}', [ProfileController::class, 'show'])->name('profile.show')
    ->middleware('auth');
Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create')
    ->middleware('auth');
Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store')
    ->middleware('auth');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')
    ->middleware('auth');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::delete('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');

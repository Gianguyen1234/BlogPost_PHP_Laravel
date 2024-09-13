<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; 
use App\Http\Controllers\HomeController; 
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
    return view('layout');
});
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/', function () {
    return view('home');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::resource('posts', PostController::class);
Route::get('/', [HomeController::class, 'index'])->name('home');



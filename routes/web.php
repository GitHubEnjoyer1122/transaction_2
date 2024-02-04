<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ViewController;
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
    return view('landing');
});


Route::post('/loginAuth', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logoutAuth', [AuthController::class, 'logout']);

Route::post('/productStore', [ProductController::class, 'store']);
Route::post('/transactions', [TransactionController::class, 'filter']);
Route::post('/menus', [ProductController::class, 'menuadd']);
Route::post('/students', [TransactionController::class, 'filter_student']);
Route::post('/payment', [TransactionController::class, 'payment']);
Route::post('/detail', [TransactionController::class, 'detail']);

Route::get('/qr', [ViewController::class, 'qr'])->middleware('auth');
Route::get('/login', [ViewController::class, 'login'])->middleware('guest')->name('login');
Route::get('/product', [ViewController::class, 'product'])->middleware('auth');
Route::get('/transaction', [ViewController::class, 'transaction'])->middleware('auth');
Route::get('/table', [ViewController::class, 'table'])->middleware('auth');
<?php

use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\HostelController;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\KhatController;
use App\Http\Controllers\Admin\UserController;
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

//admin Routes
Route::group(['prefix' => 'admin'], function (){
Route::resource('/income',IncomeController::class);
Route::resource('/expense',ExpenseController::class);
Route::resource('/khat',KhatController::class);
Route::resource('/user',UserController::class);
Route::resource('/hostel', HostelController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

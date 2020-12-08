<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/customer/create',[CustomerController::class,'create'])->name('customer.create');

Route::middleware(['auth'])->group(function () {

    Route::get('/customer/create', App\Http\Livewire\CreateCustomer::class)->name('customer.create');
    Route::get('/customer/index', App\Http\Livewire\IndexCustomer::class)->name('customer.index');
    Route::get('/order/index/{customer_id}', App\Http\Livewire\OrderIndex::class)->name('orders.index');
    Route::get('/order/create/{customer_id}', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
});



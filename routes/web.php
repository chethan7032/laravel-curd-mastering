<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return view('welcome');

})->name("home");

Route::get('/customer/trash', [CustomerController::class, 'trash'])->name('customer.trash');
Route::get('/customer/{customer}/restore',[CustomerController::class,'restoreTrash'])->name('customer.restore');
Route::get('/customer/{customer}/forcedelete',[CustomerController::class,'permentdelete'])->name('customer.permentdelete');
Route::resource('customer', CustomerController::class);

<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])
->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    //employee-route-manage
    Route::resource('employees',EmployeeController::class);
    //product-route-manage
    Route::resource('products',ProductController::class);
});

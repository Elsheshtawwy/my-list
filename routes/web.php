<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

use App\Http\Controllers\UserController;

Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

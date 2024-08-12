<?php

use Illuminate\Support\Facades\Route;

use App\Models\Task;
use App\Models\User; 
Route::get('/', function () {
    $users = User::all(); 
    return view('index')
            ->with('users', $users);
        });


 Route::get('/Task', function () {
    $tasks = Task::all(); 
    return view('Tasks')
            ->with('tasks', $tasks);
        });     


use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


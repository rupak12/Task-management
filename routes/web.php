<?php

use App\Http\Controllers\TaskController;
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
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');


Route::get('/sanctum/csrf-cookie', function () {
    return response()->json(['message' => 'CSRF token is set']);
});

Route::get('/task/list', [TaskController::class, 'index'])->name('taskList');

Route::get('/task/creation', [TaskController::class, 'create'])->name('createTask');

Route::get('/task/update/{id}', [TaskController::class, 'edit'])->name('editTask');

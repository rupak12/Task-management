<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiTaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register-save', [AuthController::class, 'register'])->name('registerSave');
Route::post('/login', [AuthController::class, 'login'])->name('loginSave');
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('userLogout');
Route::middleware('auth:sanctum')->get('/fetch-auth-user', [AuthController::class, 'fetchAuthUser'])->name('fetchAuthUser');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [ApiTaskController::class, 'index'])->name('fetchTasks');
    Route::post('/tasks', [ApiTaskController::class, 'store'])->name('saveTask');
    Route::get('/tasks/{id}', [ApiTaskController::class, 'show'])->name('fetchTask');
    Route::post('/tasks/{id}', [ApiTaskController::class, 'update'])->name('updateTask');
    Route::post('/destroy-task', [ApiTaskController::class, 'destroy'])->name('destroyTask');
});

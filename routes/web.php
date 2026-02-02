<?php

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminPanelMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
});


Route::middleware(AdminPanelMiddleware::class)->prefix('admin')->group(function () {
    Route::get('/index', [UserController::class, 'index'])->name('admin.index');
    Route::get('/show/{user}', [UserController::class, 'show'])->name('admin.show');
    Route::get('/create', [UserController::class, 'create'])->name('admin.create');
    Route::post('/store', [UserController::class, 'store'])->name('admin.store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('admin.edit');
    Route::patch('/update/{user}', [UserController::class, 'update'])->name('admin.update');
    Route::delete('/destroy/{user}', [UserController::class, 'destroy'])->name('admin.destroy');
});

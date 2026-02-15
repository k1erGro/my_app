<?php


use App\Http\Controllers\Admin\UpdatePasswordUserController;
use App\Http\Controllers\Admin\UpdateUserController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Profile\EditProfileController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Middleware\AdminPanelMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::get('/register', RegisterController::class)->name('register');
    Route::post('/register', RegisterUserController::class)->name('register.user');
    Route::get('/login', LoginController::class)->name('login');
    Route::post('/login', LoginUserController::class)->name('login.user');
    Route::post('/logout', LogoutController::class)->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/profile', ProfileController::class)->name('profile');
    Route::get('/profile/edit/{user}', EditProfileController::class)->name('profile.edit');
//    Route::patch('/profile/update/{user}', EditProfileController::class)->name('profile.update');
//    Route::patch('/profile/update_password/{user}', EditProfileController::class)->name('profile.update.password');
});

Route::middleware(AdminPanelMiddleware::class)->namespace('App\Http\Controllers\admin')->prefix('admin')->group(function () {
    Route::get('/index', UsersController::class)->name('admin.index');
    Route::get('/show/{user}', ShowUserController::class)->name('admin.show');
    Route::get('/create', CreateUserController::class)->name('admin.create');
    Route::post('/store', StoreUserController::class)->name('admin.store');
    Route::get('/edit/{user}', EditUserController::class)->name('admin.edit');
    Route::delete('/destroy/{user}', DestroyUserController::class)->name('admin.destroy');
});
Route::patch('/admin/update/{user}', UpdateUserController::class)->name('admin.update');
Route::patch('/admin/update_password/{user}', UpdatePasswordUserController::class)->name('admin.update_password');


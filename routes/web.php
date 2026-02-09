<?php



use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});
});

Route::middleware(AdminPanelMiddleware::class)->namespace('App\Http\Controllers\admin')->prefix('admin')->group(function () {
    Route::get('/index', UsersController::class)->name('admin.index');
    Route::get('/show/{user}', ShowUserController::class)->name('admin.show');
    Route::get('/create', CreateUserController::class)->name('admin.create');
    Route::post('/store', StoreUserController::class)->name('admin.store');
    Route::get('/edit/{user}', EditUserController::class)->name('admin.edit');
    Route::patch('/update/{user}', UpdateUserController::class)->name('admin.update');
    Route::delete('/destroy/{user}', DestroyUserController::class)->name('admin.destroy');

    Route::patch('/update_password/{user}', UpdatePasswordUserController::class)->name('admin.update_password');
});

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

Route::middleware(AdminPanelMiddleware::class)->prefix('admin')->group(function () {
    Route::get('/index', [UserController::class, 'index'])->name('admin.index');
    Route::get('/show/{user}', [UserController::class, 'show'])->name('admin.show');
    Route::get('/create', [UserController::class, 'create'])->name('admin.create');
    Route::post('/store', [UserController::class, 'store'])->name('admin.store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('admin.edit');
    Route::patch('/update/{user}', [UserController::class, 'update'])->name('admin.update');
    Route::delete('/destroy/{user}', [UserController::class, 'destroy'])->name('admin.destroy');
});

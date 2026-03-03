<?php


use App\Http\Controllers\admin\Categories\CreateCategoryController;
use App\Http\Controllers\admin\Categories\DestroyCategoryController;
use App\Http\Controllers\admin\Categories\EditCategoryController;
use App\Http\Controllers\admin\Categories\IndexCategoryController;
use App\Http\Controllers\admin\Categories\StoreCategoryController;
use App\Http\Controllers\admin\Categories\UpdateCategoryController;
use App\Http\Controllers\Admin\Products\CreateProductController;
use App\Http\Controllers\Admin\Products\DestroyProductController;
use App\Http\Controllers\Admin\Products\EditProductController;
use App\Http\Controllers\Admin\Products\IndexProductController;
use App\Http\Controllers\Admin\Products\ShowProductController;
use App\Http\Controllers\Admin\Products\StoreProductController;
use App\Http\Controllers\Admin\Products\UpdateProductController;
use App\Http\Controllers\admin\Users\CreateUserController;
use App\Http\Controllers\admin\Users\DestroyUserController;
use App\Http\Controllers\admin\Users\EditUserController;
use App\Http\Controllers\admin\Users\ShowUserController;
use App\Http\Controllers\admin\Users\StoreUserController;
use App\Http\Controllers\admin\Users\UpdatePasswordUserController;
use App\Http\Controllers\admin\Users\UpdateUserController;
use App\Http\Controllers\admin\Users\UsersController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Cart\CartAddController;
use App\Http\Controllers\Cart\CartDestroyController;
use App\Http\Controllers\Cart\CartShowController;
use App\Http\Controllers\Cart\CartUpdateController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Profile\EditProfileController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Product\CatalogProductController;
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
});

Route::middleware(AdminPanelMiddleware::class)->prefix('admin')->group(function () {
    // Пользователи
    Route::get('/index', UsersController::class)->name('admin.index');
    Route::get('/show/{user}', ShowUserController::class)->name('admin.show');
    Route::get('/create', CreateUserController::class)->name('admin.create');
    Route::post('/store', StoreUserController::class)->name('admin.store');
    Route::get('/edit/{user}', EditUserController::class)->name('admin.edit');

    // Категории
    Route::get('/category', IndexCategoryController::class)->name('admin.category.index');
    Route::get('/create-category', CreateCategoryController::class)->name('admin.category.create');
    Route::post('/store-category', StoreCategoryController::class)->name('admin.category.store');
    Route::get('/edit-category/{category:slug}', EditCategoryController::class)->name('admin.category.edit');
    Route::patch('/update-category/{category:slug}', UpdateCategoryController::class)->name('admin.category.update');
    Route::delete('/destroy/{category}', DestroyCategoryController::class)->name('admin.category.destroy');

    // Товары
    Route::get('/product', IndexProductController::class)->name('admin.product.index');
    Route::get('/product/create-product', CreateProductController::class)->name('admin.product.create');
    Route::post('/product/store-product', StoreProductController::class)->name('admin.product.store');
    Route::get('/product/{product:slug}', ShowProductController::class)->name('admin.product.show');
    Route::get('/product/edit-product/{product:slug}', EditProductController::class)->name('admin.product.edit');
    Route::patch('/product/update-product/{product:slug}', UpdateProductController::class)->name('admin.product.update');
    Route::delete('/product/destroy/{product}', DestroyProductController::class)->name('admin.product.destroy');
});

Route::patch('/admin/update/{user}', UpdateUserController::class)->name('admin.update');
Route::patch('/admin/update_password/{user}', UpdatePasswordUserController::class)->name('admin.update_password');
Route::delete('/admin/destroy/{user}', DestroyUserController::class)->name('admin.destroy');

Route::prefix('shop')->group(function () {

    Route::get('/', function () {
        return view('shop.welcome');
    })->name('shop.index');

    Route::get('/catalog', CategoryController::class)->name('catalog.index');
    Route::get('/catalog/{category:slug?}', CategoryController::class)->name('catalog.show');

    Route::get('/product', ProductController::class)->name('product.index');
    Route::get('/product/{product:slug}', CatalogProductController::class)->name('catalog.product');
});

Route::post('/cart/add', CartAddController::class)->name('cart.add');
Route::get('/cart', CartShowController::class)->name('cart.show');
Route::patch('/cart/update/{id}', CartUpdateController::class)->name('cart.update');
Route::delete('/cart/delete/{id}', CartDestroyController::class)->name('cart.destroy');

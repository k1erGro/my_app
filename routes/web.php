<?php


use App\Http\Controllers\Admin\Address\CreateAddressController;
use App\Http\Controllers\Admin\Address\DeleteAddressController;
use App\Http\Controllers\Admin\Address\EditAddressController;
use App\Http\Controllers\Admin\Address\ListAddressController;
use App\Http\Controllers\Admin\Address\StoreAddressController;
use App\Http\Controllers\Admin\Address\UpdateAddressController;
use App\Http\Controllers\Admin\Answer\DeleteAnswerController;
use App\Http\Controllers\Admin\Answer\ListAnswerController;
use App\Http\Controllers\Admin\Answer\ShowAnswerController;
use App\Http\Controllers\Admin\Categories\CreateCategoryController;
use App\Http\Controllers\Admin\Categories\DeleteCategoryController;
use App\Http\Controllers\Admin\Categories\EditCategoryController;
use App\Http\Controllers\Admin\Categories\ListCategoryController;
use App\Http\Controllers\Admin\Categories\StoreCategoryController;
use App\Http\Controllers\Admin\Categories\UpdateCategoryController;
use App\Http\Controllers\Admin\Coupons\CreateCouponsController;
use App\Http\Controllers\Admin\Coupons\DeleteCouponsController;
use App\Http\Controllers\Admin\Coupons\EditCouponsController;
use App\Http\Controllers\Admin\Coupons\ListCouponsController;
use App\Http\Controllers\Admin\Coupons\StoreCouponsController;
use App\Http\Controllers\Admin\Coupons\UpdateCouponsController;
use App\Http\Controllers\Admin\Orders\AdminEditOrderController;
use App\Http\Controllers\Admin\Orders\AdminListOrderController;
use App\Http\Controllers\Admin\Orders\AdminUpdateOrderController;
use App\Http\Controllers\Admin\Products\CreateProductController;
use App\Http\Controllers\Admin\Products\DeleteProductController;
use App\Http\Controllers\Admin\Products\EditProductController;
use App\Http\Controllers\Admin\Products\ListProductController;
use App\Http\Controllers\Admin\Products\ShowProductController;
use App\Http\Controllers\Admin\Products\StoreProductController;
use App\Http\Controllers\Admin\Products\UpdateProductController;
use App\Http\Controllers\Admin\Property\CreatePropertyController;
use App\Http\Controllers\Admin\Property\DeletePropertyController;
use App\Http\Controllers\Admin\Property\EditPropertyController;
use App\Http\Controllers\Admin\Property\ListPropertyController;
use App\Http\Controllers\Admin\Property\StorePropertyController;
use App\Http\Controllers\Admin\Property\UpdatePropertyController;
use App\Http\Controllers\Admin\Question\DeleteQuestionController;
use App\Http\Controllers\Admin\Question\ListQuestionController;
use App\Http\Controllers\Admin\Reviews\DeleteReviewController;
use App\Http\Controllers\Admin\Reviews\ListReviewController;
use App\Http\Controllers\Admin\Reviews\ShowReviewController;
use App\Http\Controllers\Admin\SubCategories\CreateSubcategoryController;
use App\Http\Controllers\Admin\SubCategories\DeleteSubcategoryController;
use App\Http\Controllers\Admin\SubCategories\EditSubcategoryController;
use App\Http\Controllers\Admin\SubCategories\ListSubcategoryController;
use App\Http\Controllers\Admin\SubCategories\StoreSubcategoryController;
use App\Http\Controllers\Admin\SubCategories\UpdateSubcategoryController;
use App\Http\Controllers\Admin\Users\CreateUserController;
use App\Http\Controllers\Admin\Users\DeleteUserController;
use App\Http\Controllers\Admin\Users\EditPasswordController;
use App\Http\Controllers\Admin\Users\EditUserController;
use App\Http\Controllers\Admin\Users\ShowUserController;
use App\Http\Controllers\Admin\Users\StoreUserController;
use App\Http\Controllers\Admin\Users\UpdatePasswordUserController;
use App\Http\Controllers\Admin\Users\UpdateUserController;
use App\Http\Controllers\Admin\Users\ListUserController;
use App\Http\Controllers\Answer\StoreAnswerController;
use App\Http\Controllers\Answer\UpdateAnswerController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Cart\CartAddController;
use App\Http\Controllers\Cart\CartDeleteController;
use App\Http\Controllers\Cart\CartShowController;
use App\Http\Controllers\Cart\CartUpdateController;
use App\Http\Controllers\Catalog\CategoryController;
use App\Http\Controllers\Catalog\CategoryShowController;
use App\Http\Controllers\Catalog\SubCategoryController;
use App\Http\Controllers\Coupons\ApplyCouponController;
use App\Http\Controllers\Favourites\DeleteFavoriteController;
use App\Http\Controllers\Favourites\ListFavoriteController;
use App\Http\Controllers\Favourites\StoreFavoriteController;
use App\Http\Controllers\Notifications\DeleteNotificationController;
use App\Http\Controllers\Notifications\ListNotifications;
use App\Http\Controllers\Notifications\MarkAsReadController;
use App\Http\Controllers\Notifications\ShowNotification;
use App\Http\Controllers\Notifications\SubscribeController;
use App\Http\Controllers\Orders\CancelOrderController;
use App\Http\Controllers\Orders\EditOrderController;
use App\Http\Controllers\Orders\OrdersController;
use App\Http\Controllers\Orders\ShowOrderController;
use App\Http\Controllers\Orders\StoreOrderController;
use App\Http\Controllers\Orders\UpdateOrderController;
use App\Http\Controllers\Product\AllProductController;
use App\Http\Controllers\Product\CancelSubscriptionController;
use App\Http\Controllers\Product\CatalogProductController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\SubscriptionController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Question\ShowQuestionController;
use App\Http\Controllers\Question\StoreQuestionController;
use App\Http\Controllers\Question\UpdateQuestionController;
use App\Http\Controllers\Review\StoreReviewController;
use App\Http\Controllers\Review\UpdateReviewController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('shop.welcome');
})->name('shop.index');

Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::get('/register', ShowRegisterController::class)->name('show.register');
    Route::post('/register', RegisterController::class)->name('register');
    Route::get('/login', ShowLoginController::class)->name('show.login');
    Route::post('/login', LoginController::class)->name('login');
    Route::post('/logout', LogoutController::class)->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/profile', ProfileController::class)->name('profile');
    Route::get('/profile/edit/{user}', EditUserController::class)->name('profile.edit');
    Route::patch('/profile/update/{user}', UpdateUserController::class)->name('profile.update');
    Route::get('/profile/edit-password/{user}', EditPasswordController::class)->name('profile.edit.password');
    Route::patch('/profile/update-password/{user}', UpdatePasswordUserController::class)->name('profile.update_password');
    Route::delete('/profile/destroy/{user}', DeleteUserController::class)->name('profile.destroy');
});

Route::middleware(RoleMiddleware::using(['Admin', 'TechnicalSpecialist', 'Director', 'Manager']))->prefix('admin')->group(function () {
    // Пользователи
    Route::get('/index', ListUserController::class)->name('admin.index');
    Route::get('/show/{user}', ShowUserController::class)->name('admin.show');
    Route::get('/create', CreateUserController::class)->name('admin.create');
    Route::post('/store', StoreUserController::class)->name('admin.store');
    Route::get('/edit/{user}', EditUserController::class)->name('admin.edit');
    Route::patch('/admin/update/{user}', UpdateUserController::class)->name('admin.update');
    Route::get('/edit_password/{user}', EditPasswordController::class)->name('admin.edit_password');
    Route::patch('/admin/update_password/{user}', UpdatePasswordUserController::class)->name('admin.update_password');
    Route::delete('/admin/destroy/{user}', DeleteUserController::class)->name('admin.destroy');

    // Категории
    Route::get('/category', ListCategoryController::class)->name('admin.category.index');
    Route::get('/create-category', CreateCategoryController::class)->name('admin.category.create');
    Route::post('/store-category', StoreCategoryController::class)->name('admin.category.store');
    Route::get('/edit-category/{category:slug}', EditCategoryController::class)->name('admin.category.edit');
    Route::patch('/update-category/{category:slug}', UpdateCategoryController::class)->name('admin.category.update');
    Route::delete('/destroy-category/{category}', DeleteCategoryController::class)->name('admin.category.destroy');

    //Подкатегории

    Route::get('/subcategory', ListSubcategoryController::class)->name('admin.subCategory.index');
    Route::get('/create-subcategory', CreateSubcategoryController::class)->name('admin.subCategory.create');
    Route::post('/store-subcategory', StoreSubcategoryController::class)->name('admin.subCategory.store');
    Route::get('/edit-subcategory/{subCategory:slug}', EditSubcategoryController::class)->name('admin.subCategory.edit');
    Route::patch('/update-subcategory/{subCategory:slug}', UpdateSubcategoryController::class)->name('admin.subCategory.update');
    Route::delete('/destroy-subcategory/{subCategory}', DeleteSubcategoryController::class)->name('admin.subCategory.destroy');

    // Товары
    Route::get('/product', ListProductController::class)->name('admin.product.index');
    Route::get('/create-product', CreateProductController::class)->name('admin.product.create');
    Route::post('/store-product', StoreProductController::class)->name('admin.product.store');
    Route::get('/product/{product:slug}', ShowProductController::class)->name('admin.product.show');
    Route::get('/edit-product/{product:slug}', EditProductController::class)->name('admin.product.edit');
    Route::patch('/update-product/{product:slug}', UpdateProductController::class)->name('admin.product.update');
    Route::delete('/destroy/{product}', DeleteProductController::class)->name('admin.product.destroy');

    // Характеристики
    Route::get('/property', ListPropertyController::class)->name('admin.property.index');
    Route::get('/create-property', CreatePropertyController::class)->name('admin.property.create');
    Route::post('/store-property', StorePropertyController::class)->name('admin.property.store');
    Route::get('/edit-property/{property:slug}', EditPropertyController::class)->name('admin.property.edit');
    Route::patch('/update-property/{property:slug}', UpdatePropertyController::class)->name('admin.property.update');
    Route::delete('/destroy-property/{property}', DeletePropertyController::class)->name('admin.property.destroy');

    // Адреса
    Route::get('/address', ListAddressController::class)->name('admin.address.index');
    Route::get('/create-address', CreateAddressController::class)->name('admin.address.create');
    Route::post('/store-address', StoreAddressController::class)->name('admin.address.store');
    Route::get('/edit-address/{address:slug}', EditAddressController::class)->name('admin.address.edit');
    Route::patch('/update-address/{address:slug}', UpdateAddressController::class)->name('admin.address.update');
    Route::delete('/destroy-address/{address}', DeleteAddressController::class)->name('admin.address.destroy');

    // Заказы
    Route::get('/orders', AdminListOrderController::class)->name('admin.orders.index');
    Route::get('/edit-orders/{order}', AdminEditOrderController::class)->name('admin.orders.edit');
    Route::patch('/update-orders/{order}', AdminUpdateOrderController::class)->name('admin.orders.update');

    // Отзывы
    Route::get('/reviews', ListReviewController::class)->name('admin.reviews.index');
    Route::get('/show-review/{review}', ShowReviewController::class)->name('admin.reviews.show');
    Route::delete('/destroy-review/{review}', DeleteReviewController::class)->name('admin.reviews.destroy');

    //Вопросы
    Route::get('/questions', ListQuestionController::class)->name('admin.questions.list');
    Route::get('/show-question/{question}', ShowQuestionController::class)->name('admin.question.show');
    Route::delete('/delete-question/{question}', DeleteQuestionController::class)->name('admin.question.destroy');

    //Ответы
    Route::get('/answers', ListAnswerController::class)->name('admin.answers.list');
    Route::get('/show-answers/{answer}', ShowAnswerController::class)->name('admin.answer.show');
    Route::delete('/delete-answer/{answer}', DeleteAnswerController::class)->name('admin.answer.destroy');

    // Купоны
    Route::get('/coupons', ListCouponsController::class)->name('admin.coupons.list');
    Route::get('/create-coupons', CreateCouponsController::class)->name('admin.coupons.create');
    Route::post('/store-coupons', StoreCouponsController::class)->name('admin.coupons.store');
    Route::get('/edit-coupons/{coupon}', EditCouponsController::class)->name('admin.coupons.edit');
    Route::patch('/update-coupons/{coupon}', UpdateCouponsController::class)->name('admin.coupons.update');
    Route::delete('/delete-coupons/{coupon}', DeleteCouponsController::class)->name('admin.coupons.delete');

});


Route::prefix('shop')->group(function () {

    Route::get('/catalog', CategoryController::class)->name('catalog.index');
    Route::get('/catalog/{category:slug}', SubCategoryController::class)->name('catalog.show');
    Route::get('/catalog/sub-category/{subCategory:slug}', CatalogProductController::class)->name('catalog.product');

    Route::get('/product', AllProductController::class)->name('product.index');
    Route::get('/product/{product:slug}', ProductController::class)->name('product.show');

    Route::get('/orders', OrdersController::class)->name('orders.index');
    Route::post('/store-order', StoreOrderController::class)->name('orders.store');
    Route::get('/edit-order/{order}', EditOrderController::class)->name('orders.edit');
    Route::patch('/update-order/{order}', UpdateOrderController::class)->name('orders.update');
    Route::get('/orders/{order}', ShowOrderController::class)->name('orders.show');
    Route::delete('/delete-order/{order}', CancelOrderController::class)->name('orders.delete');

    Route::post('/store-review', StoreReviewController::class)->name('review.store');
    Route::patch('/update-review/{review}', UpdateReviewController::class)->name('review.update');

    Route::post('/store-question', StoreQuestionController::class)->name('question.store');
    Route::patch('/update-question/{question}', UpdateQuestionController::class)->name('question.update');
    Route::get('/show-question/{question}', ShowQuestionController::class)->name('question.show');

    Route::post('/store-answer', StoreAnswerController::class)->name('answer.store');
    Route::patch('/update-answer/{answer}', UpdateAnswerController::class)->name('answer.update');

    Route::get('/favourites', ListFavoriteController::class)->name('favourites.list');
    Route::post('/store-favorite/{product}', StoreFavoriteController::class)->name('favourites.store');
    Route::delete('/delete-favorite/{favorite}', DeleteFavoriteController::class)->name('favourites.delete');

    Route::post('/update-order/{order}/apply-coupon', ApplyCouponController::class)->name('coupon.apply');

    Route::get('/notifications', ListNotifications::class)->name('notifications.list');
    Route::get('/notification/{notification}', ShowNotification::class)->name('notification.show');
    Route::post('/notification-mark-read/{notification}', MarkAsReadController::class)->name('notification.mark-read');
    Route::patch('/subscribe-notification/{user}', SubscribeController::class)->name('profile.subscribe-notifications');
    Route::delete('/notifications-delete/{notification}', DeleteNotificationController::class)->name('notifications.delete');

    Route::post('/subscribe/{product}', SubscriptionController::class)->name('product.subscribe');
    Route::post('/subscribe/{product}', SubscriptionController::class)->name('product.subscribe');
    Route::delete('/cancel-subscription/{product}', CancelSubscriptionController::class)->name('product.cancel-subscribe');
});

Route::post('/cart/add', CartAddController::class)->name('cart.add');
Route::get('/cart', CartShowController::class)->name('cart.show');
Route::patch('/cart/update/{id}', CartUpdateController::class)->name('cart.update');
Route::delete('/cart/delete/{id}', CartDeleteController::class)->name('cart.destroy');

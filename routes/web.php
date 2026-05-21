<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\CheckAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Nhóm Guest: Chỉ truy cập được khi CHƯA đăng nhập
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// 2. Nhóm Auth: Chỉ truy cập được khi ĐÃ đăng nhập (Tất cả User & Admin đều vào được)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// 3. Nhóm Admin: Bắt buộc Đã đăng nhập VÀ phải vượt qua trạm kiểm soát CheckAdmin
Route::middleware(['auth', CheckAdmin::class])->group(function () {

    Route::resource('/admin/users', UserController::class);

    Route::resource('/admin/categories', CategoryController::class);

    Route::resource('/admin/products', ProductController::class);

    Route::resource('/admin/orders', OrderController::class)
        ->only(['index', 'show']);
});

// 4. Route mặc định: Cứ vào trang chủ (/) là tự động đá sang trang login
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/products', [ProductController::class, 'shop']);

Route::get('/products/{slug}', [ProductController::class, 'detail']);

Route::get('/cart', [CartController::class, 'index']);

Route::post('/add-to-cart/{id}', [CartController::class, 'add']);

Route::post('/cart/update/{id}', [CartController::class, 'update']);

Route::get('/cart/remove/{id}', [CartController::class, 'remove']);

Route::get('/checkout', [CheckoutController::class, 'index']);

Route::post('/checkout', [CheckoutController::class, 'store']);
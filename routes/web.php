<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckAdmin; // Gọi middleware kiểm tra Admin

// 1. Nhóm Guest: Chỉ truy cập được khi CHƯA đăng nhập
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// 2. Nhóm Auth: Chỉ truy cập được khi ĐÃ đăng nhập (User thường & Admin đều vào được)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// 3. Nhóm Admin: Bắt buộc Đã đăng nhập VÀ phải có role = 1 (Chỉ Admin mới vào được)
Route::middleware(['auth', CheckAdmin::class])->group(function () {
    Route::get('/admin', function () {
        return '<h1 style="color: blue; text-align: center; margin-top: 50px;">Chào mừng Sếp! Đây là trang quản trị nội bộ.</h1>';
    });
});

// 4. Route mặc định: Vào thẳng trang login
Route::get('/', function () {
    return redirect('/login');
});
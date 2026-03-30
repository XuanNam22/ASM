<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return redirect()->route('login');
});

// NHÓM CHƯA ĐĂNG NHẬP (Khách)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// NHÓM ĐÃ ĐĂNG NHẬP
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// KHU VỰC CỦA ADMIN 
Route::middleware(['admin'])->prefix('admin')->group(function () {
    
    // Đã chuyển phần function() lằng nhằng sang file DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Quản lý Tours
    Route::resource('tours', TourController::class);
    // Booking
    Route::resource('bookings', BookingController::class);

});

// KHU VỰC CỦA HƯỚNG DẪN VIÊN
Route::middleware(['guide'])->prefix('guide')->group(function () {
    
    Route::get('/dashboard', function () {
        return 'Đây là trang tổng quan của Hướng dẫn viên';
    })->name('guide.dashboard');

});
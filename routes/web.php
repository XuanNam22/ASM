<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\Guide\DashboardController as GuideDashboardController;
use App\Http\Controllers\Guide\TourController as GuideTourController;
use App\Http\Controllers\Guide\ProfileController as GuideProfileController;
use App\Http\Controllers\AttendanceController;

// ... (code cũ của bạn) ...

// KHU VỰC CỦA HƯỚNG DẪN VIÊN
Route::middleware(['guide'])->prefix('guide')->group(function () {

    // Thay thế function() cũ bằng Controller
    Route::get('/dashboard', [GuideDashboardController::class, 'index'])->name('guide.dashboard');
});

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
    // HDV
    Route::resource('guides', GuideController::class);
});

// KHU VỰC CỦA HƯỚNG DẪN VIÊN
// Thêm ->name('guide.') để tự động nối chữ "guide." vào trước tất cả các name bên trong
Route::middleware(['guide'])->prefix('guide')->name('guide.')->group(function () {

    Route::get('/dashboard', [GuideDashboardController::class, 'index'])->name('dashboard');
    Route::get('/tours/{id}', [GuideTourController::class, 'show'])->name('tours.show');
    Route::post('/tours/{id}/attendance', [GuideTourController::class, 'saveAttendance'])->name('tours.attendance.save');
    Route::get('/profile', [GuideProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [GuideProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth'])->group(function () {
    // Route xem danh sách điểm danh của 1 tour
    Route::get('/tours/{tour_id}/attendances', [AttendanceController::class, 'index'])->name('attendances.index');

    // Route lưu/cập nhật kết quả điểm danh
    Route::post('/tours/{tour_id}/attendances', [AttendanceController::class, 'store'])->name('attendances.store');
});
<?php

use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\TinTucController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('admin.index');});
Route::get('/danh-sach-nhan-vien', [NhanVienController::class, 'index'])->name('nhanvien.index');
Route::get('/danh-sach-tin-tuc', [TinTucController::class, 'index'])->name('tintuc.index');
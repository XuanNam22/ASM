<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    /** @use HasFactory<\Database\Factories\NhanVienFactory> */
    use HasFactory;

    protected $table = 'nhan_viens';

    protected $fillable = [
        'ho_ten',
        'email',
        'ngay_sinh',
        'gioi_tinh',
        'luong',
        'phong_ban'
    ];
}

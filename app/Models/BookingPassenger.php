<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingPassenger extends Model
{
    protected $fillable = [
        'booking_id', 'name', 'dob', 'id_card', 'note'
    ];

    // Hành khách này thuộc về Đơn đặt (Booking) nào?
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    
    // Liên kết với bảng điểm danh (Đoạn này chuẩn bị cho việc sửa lỗi số 3 về sau)
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'passenger_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'name', 
        'image', 
        'destination', 
        'start_date', 
        'end_date', 
        'price', 
        'guide_id', 
        'status'
    ];

    // Tour này do Hướng dẫn viên nào dẫn?
    public function guide()
    {
        return $this->belongsTo(User::class, 'guide_id');
    }

    // Tour này có những Booking (đơn đặt) nào?
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Danh sách điểm danh của Tour này
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}

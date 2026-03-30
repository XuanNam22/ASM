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
        'max_passengers',
        'min_passengers',
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
    // Tính tổng số vé đã được đặt cho tour này
    public function totalBookedTickets()
    {
        // Trừ các đơn hàng đã bị hủy ra khỏi tổng số vé
        return $this->bookings()->where('payment_status', '!=', 'cancelled')->sum('quantity');
    }

    // Kiểm tra xem tour còn bao nhiêu chỗ trống
    public function availableSeats()
    {
        return $this->max_passengers - $this->totalBookedTickets();
    }

    //Kiểm tra tour đã đủ điều kiện khởi hành chưa
    public function canDepart()
    {
        return $this->totalBookedTickets() >= $this->min_passengers;
    }
}

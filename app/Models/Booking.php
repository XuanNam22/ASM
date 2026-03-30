<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'tour_id', 'customer_name', 'customer_phone', 'customer_email', 'quantity', 'total_price', 'payment_status'
    ];

    // Đơn đặt này thuộc về Tour nào?
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    // Lịch sử điểm danh của nhóm khách hàng này
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}

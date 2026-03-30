<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'tour_id', 'customer_name', 'customer_phone', 'customer_email', 
        'quantity', 'total_price', 'paid_amount', 'payment_status' 
    ];

    // Đơn đặt này thuộc về Tour nào?
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    // 1 Đơn đặt (Booking) sẽ có NHIỀU Hành khách (BookingPassengers) ---
    public function passengers()
    {
        return $this->hasMany(BookingPassenger::class);
    }

    // Tính số tiền khách còn nợ (Tổng tiền - Số tiền đã trả)
    public function remainingBalance()
    {
        return $this->total_price - $this->paid_amount;
    }
}

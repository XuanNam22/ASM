<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'tour_id', 'passenger_id', 'is_present', 'guide_note', 'report_date'
    ];

    // Phiếu điểm danh này thuộc về Tour nào?
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    // Phiếu điểm danh này dành cho nhóm khách (Booking) nào?
    public function passenger()
    {
        return $this->belongsTo(BookingPassenger::class, 'passenger_id');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Đếm số lượng dữ liệu thực tế từ Database
        $totalTours = Tour::count();
        $totalGuides = User::where('role', 'guide')->count();
        $totalBookings = Booking::count();
        
        // Tính tổng tiền các booking
        $revenue = Booking::where('payment_status', 'completed')->sum('total_price');

        // Lấy ra 5 tour mới nhất
        $recentTours = Tour::latest()->take(5)->get();

        // Trả về view và ném các biến sang
        return view('admin.index', compact('totalTours', 'totalGuides', 'totalBookings', 'revenue', 'recentTours'));
    }
}
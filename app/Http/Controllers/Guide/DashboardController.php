<?php

namespace App\Http\Controllers\Guide;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Thống kê nhanh số liệu (Chỉ tính những tour của HDV này)
        $totalTours = Tour::where('guide_id', $user->id)->count();
        $ongoingTours = Tour::where('guide_id', $user->id)->where('status', 'ongoing')->count();
        $upcomingTours = Tour::where('guide_id', $user->id)
            ->where('status', 'open')
            ->where('start_date', '>=', now())
            ->count();

        // 2. Lấy danh sách Tour được phân công (Mới nhất lên trước, phân trang 10)
        $myTours = Tour::where('guide_id', $user->id)->latest()->paginate(10);

        // Trả về view kèm dữ liệu
        return view('guide.dashboard', compact('myTours', 'totalTours', 'ongoingTours', 'upcomingTours'));
    }
}

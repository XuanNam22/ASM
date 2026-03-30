<?php

namespace App\Http\Controllers\Guide;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TourController extends Controller
{
    // Hiển thị danh sách khách hàng trong Tour để điểm danh
    public function show($id)
    {
        // Lấy tour kèm theo danh sách booking (nhóm khách)
        $tour = Tour::with('bookings')->findOrFail($id);

        // Bảo mật: Nếu Tour này không phải do HDV này dẫn thì đá ra lỗi 403
        if ($tour->guide_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền truy cập Tour này!');
        }

        // Lấy ngày hôm nay
        $today = Carbon::now()->format('Y-m-d');

        // Lấy dữ liệu điểm danh CỦA NGÀY HÔM NAY để hiển thị lại nếu HDV đã điểm danh rồi
        $attendances = Attendance::where('tour_id', $tour->id)
            ->where('report_date', $today)
            ->get()
            ->keyBy('booking_id'); // keyBy để dễ lấy ra trong Blade

        return view('guide.tours.show', compact('tour', 'attendances', 'today'));
    }

    // Xử lý lưu điểm danh
    public function saveAttendance(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);

        if ($tour->guide_id !== Auth::id()) {
            abort(403);
        }

        $today = Carbon::now()->format('Y-m-d');
        $bookings = $tour->bookings;

        // Duyệt qua từng booking để lưu/cập nhật điểm danh
        foreach ($bookings as $booking) {
            // Nếu checkbox được tick thì mảng is_present sẽ có key là ID của booking đó
            $isPresent = $request->has("is_present.{$booking->id}");
            $note = $request->input("guide_note.{$booking->id}");

            // Dùng updateOrCreate: Nếu hôm nay chưa điểm danh thì Tạo mới, điểm danh rồi thì Cập nhật
            Attendance::updateOrCreate(
                [
                    'tour_id' => $tour->id,
                    'booking_id' => $booking->id,
                    'report_date' => $today
                ],
                [
                    'is_present' => $isPresent,
                    'guide_note' => $note
                ]
            );
        }

        return back()->with('success', 'Đã lưu báo cáo điểm danh ngày hôm nay (' . Carbon::parse($today)->format('d/m/Y') . ')!');
    }
}

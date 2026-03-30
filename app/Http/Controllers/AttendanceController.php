<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Tour;
use App\Models\BookingPassenger;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Hiển thị danh sách khách hàng để Hướng dẫn viên điểm danh.
     * Lưu ý: Cần truyền $tour_id vào để biết đang điểm danh cho Tour nào.
     */
    public function index($tour_id)
    {
        // 1. Lấy thông tin Tour
        $tour = Tour::findOrFail($tour_id);

        // 2. Lấy danh sách TOÀN BỘ hành khách của tour này 
        // (Chỉ lấy những người thuộc các Booking chưa bị hủy)
        $passengers = BookingPassenger::whereHas('booking', function($query) use ($tour_id) {
            $query->where('tour_id', $tour_id)
                  ->where('payment_status', '!=', 'cancelled');
        })->get();

        // 3. Lấy dữ liệu điểm danh của ngày hôm nay (nếu HDV đã điểm danh trước đó rồi thì hiện lại kết quả)
        $today = Carbon::today()->toDateString();
        $attendancesToday = Attendance::where('tour_id', $tour_id)
                                      ->where('report_date', $today)
                                      ->get()
                                      ->keyBy('passenger_id'); // Nhóm theo ID khách để View dễ kiểm tra

        return view('guide.attendances.index', compact('tour', 'passengers', 'attendancesToday', 'today'));
    }

    /**
     * Xử lý lưu kết quả điểm danh hàng loạt (Dùng chung cho cả Thêm mới và Cập nhật)
     */
    public function store(Request $request, $tour_id)
    {
        // Validate dữ liệu gửi lên
        $request->validate([
            'present_passengers' => 'nullable|array', // Mảng chứa ID các khách có mặt
            'notes' => 'nullable|array',              // Mảng chứa ghi chú của HDV
        ]);

        $report_date = Carbon::today()->toDateString();
        
        // Nếu không có ai được tick, mảng sẽ rỗng
        $presentIds = $request->present_passengers ?? [];
        $notes = $request->notes ?? [];

        // Lấy lại danh sách khách để duyệt qua và lưu
        $passengers = BookingPassenger::whereHas('booking', function($query) use ($tour_id) {
            $query->where('tour_id', $tour_id);
        })->get();

        // Vòng lặp lưu điểm danh cho TỪNG người
        foreach ($passengers as $passenger) {
            Attendance::updateOrCreate(
                // Điều kiện tìm kiếm (Mỗi khách chỉ có 1 dòng điểm danh / 1 ngày trong 1 tour)
                [
                    'tour_id' => $tour_id, 
                    'passenger_id' => $passenger->id, 
                    'report_date' => $report_date
                ],
                // Dữ liệu cần cập nhật/thêm mới
                [
                    'is_present' => in_array($passenger->id, $presentIds), // in_array trả về true/false
                    'guide_note' => $notes[$passenger->id] ?? null
                ]
            );
        }

        // Quay lại trang trước và báo thành công
        return redirect()->back()->with('success', 'Đã lưu điểm danh ngày ' . Carbon::today()->format('d/m/Y') . ' thành công!');
    }
    public function create() { }
    public function show(Attendance $attendance) { }
    public function edit(Attendance $attendance) { }
    public function update(Request $request, Attendance $attendance) { }
    public function destroy(Attendance $attendance) { }
}
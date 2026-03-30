<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // 1. Hiển thị danh sách Booking
    public function index()
    {
        // Lấy danh sách booking kèm thông tin tour, phân trang 10 dòng
        $bookings = Booking::with('tour')->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    // 2. Hiển thị form tạo mới
    public function create()
    {
        // Lấy danh sách Tour để admin chọn khi đặt chỗ
        $tours = Tour::latest()->get();
        return view('admin.bookings.create', compact('tours'));
    }

    // 3. Xử lý lưu Booking mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'quantity' => 'required|integer|min:1',
            'payment_status' => 'required|in:unpaid,deposit,completed,cancelled',
        ]);

        // Logic tự động tính Tổng tiền = Giá tour * Số lượng vé
        $tour = Tour::findOrFail($request->tour_id);
        $validated['total_price'] = $tour->price * $validated['quantity'];

        Booking::create($validated);

        return redirect()->route('bookings.index')->with('success', 'Tạo Booking mới thành công!');
    }

    // 4. Xem chi tiết (Tạm thời bỏ qua nếu chưa cần)
    public function show(Booking $booking)
    {
        //
    }

    // 5. Hiển thị form chỉnh sửa
    public function edit(Booking $booking)
    {
        $tours = Tour::latest()->get();
        return view('admin.bookings.edit', compact('booking', 'tours'));
    }

    // 6. Xử lý cập nhật Booking
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'quantity' => 'required|integer|min:1',
            'payment_status' => 'required|in:unpaid,deposit,completed,cancelled',
        ]);

        // Cập nhật lại tổng tiền nếu Admin có thay đổi Tour hoặc Số lượng
        $tour = Tour::findOrFail($request->tour_id);
        $validated['total_price'] = $tour->price * $validated['quantity'];

        $booking->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Cập nhật Booking thành công!');
    }

    // 7. Xử lý xóa Booking
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Đã xóa Booking thành công!');
    }
}
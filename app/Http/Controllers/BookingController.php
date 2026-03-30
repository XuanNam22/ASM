<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('tour')->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $tours = Tour::latest()->get();
        return view('admin.bookings.create', compact('tours'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'quantity' => 'required|integer|min:1',
            'payment_status' => 'required|in:unpaid,deposit,completed,cancelled',
            'paid_amount' => 'nullable|numeric|min:0',
            'passengers' => 'required|array',
            'passengers.*.name' => 'required|string|max:255', 
            'passengers.*.dob' => 'nullable|date',
            'passengers.*.id_card' => 'nullable|string|max:20',
            'passengers.*.note' => 'nullable|string|max:500',
        ]);

        $tour = Tour::findOrFail($request->tour_id);
        $validated['total_price'] = $tour->price * $validated['quantity'];
        $validated['paid_amount'] = $request->paid_amount ?? 0; 

        // 1. Tạo Booking
        $booking = Booking::create($validated);

        // 2. Lưu danh sách hành khách chi tiết
        if ($request->has('passengers')) {
            foreach ($request->passengers as $passengerData) {
                $booking->passengers()->create($passengerData);
            }
        }

        return redirect()->route('bookings.index')->with('success', 'Tạo Booking và danh sách khách thành công!');
    }

    public function show(Booking $booking)
    {
        //
    }

    public function edit(Booking $booking)
    {
        $tours = Tour::latest()->get();
        return view('admin.bookings.edit', compact('booking', 'tours'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'quantity' => 'required|integer|min:1',
            'payment_status' => 'required|in:unpaid,deposit,completed,cancelled',
            'paid_amount' => 'nullable|numeric|min:0',
        ]);

        $tour = Tour::findOrFail($request->tour_id);
        $validated['total_price'] = $tour->price * $validated['quantity'];
        $validated['paid_amount'] = $request->paid_amount ?? $booking->paid_amount;

        $booking->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Cập nhật Booking thành công!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Đã xóa Booking thành công!');
    }
}

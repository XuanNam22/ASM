<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Tối ưu 1: Dùng paginate(10) thay cho get() để phân trang
        $tours = Tour::with('guide')->latest()->paginate(10);

        return view('admin.tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guides = User::where('role', 'guide')->get();
        return view('admin.tours.create', compact('guides'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Tối ưu 2: Gán kết quả validate vào biến $validated
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'destination'    => 'required|string|max:255',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'price'          => 'required|numeric|min:0|max:99000000',
            'max_passengers' => 'required|integer|min:1',
            'min_passengers' => 'required|integer|min:1|lte:max_passengers', 
            'guide_id'       => 'nullable|exists:users,id',
            'status'         => 'required|in:open,ongoing,closed,cancelled,completed',
        ], [
            'max_passengers.required' => 'Vui lòng nhập số chỗ tối đa.',
            'max_passengers.min'      => 'Số chỗ tối đa phải từ 1 trở lên.',
            'min_passengers.required' => 'Vui lòng nhập số khách tối thiểu.',
            'min_passengers.lte'      => 'Số khách tối thiểu không được lớn hơn số chỗ tối đa.',
            'status.in'               => 'Trạng thái không hợp lệ.'
        ]);

        // Chỉ lưu những dữ liệu đã được validate
        Tour::create($validated);

        return redirect()->route('tours.index')->with('success', 'Đã thêm Tour mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        $guides = User::where('role', 'guide')->get();
        return view('admin.tours.edit', compact('tour', 'guides'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tour $tour)
    {
        // Tối ưu tương tự hàm store
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price' => 'required|numeric|min:0|max:99000000',
            'guide_id' => 'nullable|exists:users,id',
            'status' => 'required|in:open,ongoing,closed',
        ]);

        $tour->update($validated);

        return redirect()->route('tours.index')->with('success', 'Cập nhật Tour thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        $tour->delete();
        return redirect()->route('tours.index')->with('success', 'Đã xóa Tour thành công!');
    }
}

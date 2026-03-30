<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy tất cả tour, kèm theo thông tin của người hướng dẫn (guide), sắp xếp mới nhất lên đầu
        $tours = Tour::with('guide')->latest()->get();

        // Trả về giao diện và truyền biến $tours sang
        return view('admin.tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Lấy danh sách các User có quyền là 'guide' để Admin chọn gán vào Tour
        $guides = User::where('role', 'guide')->get();

        return view('admin.tours.create', compact('guides'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Xác thực dữ liệu (Validation)
        $request->validate([
            'name' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date', // Ngày kết thúc phải sau hoặc bằng ngày bắt đầu
            'price' => 'required|numeric|min:0|max:99000000',
            'guide_id' => 'nullable|exists:users,id', // Có thể để trống, nếu có thì phải là id hợp lệ trong bảng users
            'status' => 'required|in:open,ongoing,closed',
        ]);

        // 2. Lưu dữ liệu vào Database
        Tour::create($request->all());

        // 3. Điều hướng về lại trang danh sách Tour kèm theo thông báo thành công
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
    // 3. Hiển thị Form sửa thông tin Tour
    public function edit(Tour $tour)
    {
        // Lấy danh sách hướng dẫn viên để hiện ra select box
        $guides = User::where('role', 'guide')->get();

        return view('admin.tours.edit', compact('tour', 'guides'));
    }

    // 4. Xử lý lưu dữ liệu sau khi sửa
    public function update(Request $request, Tour $tour)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price' => 'required|numeric|min:0|max:99000000',
            'guide_id' => 'nullable|exists:users,id',
            'status' => 'required|in:open,ongoing,closed',
        ]);

        // Cập nhật dữ liệu mới vào record hiện tại
        $tour->update($request->all());

        return redirect()->route('tours.index')->with('success', 'Cập nhật Tour thành công!');
    }

    // 5. Xử lý Xóa Tour
    public function destroy(Tour $tour)
    {
        $tour->delete();
        return redirect()->route('tours.index')->with('success', 'Đã xóa Tour thành công!');
    }
}

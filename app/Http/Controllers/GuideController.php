<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuideController extends Controller
{
    // 1. Hiển thị danh sách Hướng dẫn viên
    public function index()
    {
        // Chỉ lấy user có role là 'guide', phân trang 10 người/trang
        $guides = User::where('role', 'guide')->latest()->paginate(10);
        return view('admin.guides.index', compact('guides'));
    }

    // 2. Form thêm mới HDV
    public function create()
    {
        return view('admin.guides.create');
    }

    // 3. Xử lý lưu HDV mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Tạo user mới, tự động gán role là guide và mã hóa mật khẩu
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'guide',
        ]);

        return redirect()->route('guides.index')->with('success', 'Đã thêm Hướng dẫn viên mới thành công!');
    }

    // 4. Form chỉnh sửa HDV
    public function edit($id)
    {
        $guide = User::where('role', 'guide')->findOrFail($id);
        return view('admin.guides.edit', compact('guide'));
    }

    // 5. Xử lý cập nhật thông tin HDV
    public function update(Request $request, $id)
    {
        $guide = User::where('role', 'guide')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // Bỏ qua check unique email cho chính user đang sửa
            'email' => 'required|email|unique:users,email,' . $guide->id,
            'password' => 'nullable|string|min:6', // Mật khẩu có thể bỏ trống nếu không muốn đổi
        ]);

        $guide->name = $validated['name'];
        $guide->email = $validated['email'];
        
        // Nếu Admin có nhập mật khẩu mới thì mới cập nhật
        if (!empty($validated['password'])) {
            $guide->password = Hash::make($validated['password']);
        }

        $guide->save();

        return redirect()->route('guides.index')->with('success', 'Cập nhật thông tin thành công!');
    }

    // 6. Xóa HDV
    public function destroy($id)
    {
        $guide = User::where('role', 'guide')->findOrFail($id);
        $guide->delete();
        
        return redirect()->route('guides.index')->with('success', 'Đã xóa Hướng dẫn viên!');
    }
}
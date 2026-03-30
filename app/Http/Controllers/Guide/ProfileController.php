<?php

namespace App\Http\Controllers\Guide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Hiển thị trang thông tin cá nhân
    public function index()
    {
        $user = Auth::user();
        return view('guide.profile', compact('user'));
    }

    // Xử lý cập nhật thông tin
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validate dữ liệu
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // Email phải duy nhất, nhưng bỏ qua ID của chính user hiện tại
            'email' => 'required|email|unique:users,email,' . $user->id,
            // Mật khẩu cho phép trống. Nếu nhập thì phải khớp với ô xác nhận (confirmed)
            'password' => 'nullable|string|min:6|confirmed', 
        ], [
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.'
        ]);

        // Cập nhật thông tin
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Chỉ cập nhật mật khẩu nếu người dùng có nhập mật khẩu mới
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Đã cập nhật thông tin cá nhân thành công!');
    }
}
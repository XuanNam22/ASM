@extends('layouts.adminLayouts')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Thông tin cá nhân</h2>
        <a href="{{ route('guide.dashboard') }}" class="btn btn-secondary">Quay lại Tổng quan</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="feather feather-check-circle me-2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-12 mb-4">
            <div class="card shadow-sm border-0 text-center py-5">
                <div class="card-body">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0d6efd&color=fff&size=150&bold=true" 
                         alt="Avatar" class="rounded-circle shadow mb-4 border border-4 border-light">
                    <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-3">Hướng dẫn viên</p>
                    
                    <div class="d-flex justify-content-center align-items-center mb-2 text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="feather feather-mail me-2 text-primary"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        {{ $user->email }}
                    </div>
                    <div class="d-flex justify-content-center align-items-center text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="feather feather-calendar me-2 text-success"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        Tham gia: {{ $user->created_at->format('d/m/Y') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7 col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Cập nhật hồ sơ</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('guide.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email đăng nhập <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h6 class="fw-bold mb-3 text-warning">Đổi mật khẩu (Tùy chọn)</h6>
                        <p class="text-muted small mb-3">Nếu không muốn đổi mật khẩu, vui lòng để trống 2 ô bên dưới.</p>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Mật khẩu mới</label>
                                <input type="password" name="password" class="form-control" placeholder="Ít nhất 6 ký tự">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nhập lại mật khẩu mới</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu">
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="feather feather-save me-1"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                                Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
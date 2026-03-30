@extends('layouts.adminLayouts')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Thêm Hướng dẫn viên mới</h2>
        <a href="{{ route('guides.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm" style="max-width: 800px; margin: 0 auto;">
        <div class="card-body p-4">
            <form action="{{ route('guides.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label text-dark fw-bold">Họ và tên <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="VD: Trần Dương">
                </div>

                <div class="mb-3">
                    <label class="form-label text-dark fw-bold">Email đăng nhập <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="VD: duong@gmail.com">
                    <div class="form-text">Email này phải là duy nhất, không trùng với người khác trong hệ thống.</div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-dark fw-bold">Mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" required placeholder="Ít nhất 6 ký tự">
                </div>

                <button type="submit" class="btn btn-success px-5 w-100">Lưu Hướng dẫn viên</button>
            </form>
        </div>
    </div>
</div>
@endsection
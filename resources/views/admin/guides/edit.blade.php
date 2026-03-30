@extends('layouts.adminLayouts')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Sửa thông tin: <span class="text-primary">{{ $guide->name }}</span></h2>
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
            <form action="{{ route('guides.update', $guide->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label text-dark fw-bold">Họ và tên <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $guide->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-dark fw-bold">Email đăng nhập <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $guide->email) }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-dark fw-bold">Mật khẩu mới</label>
                    <input type="password" name="password" class="form-control" placeholder="Chỉ nhập khi muốn đổi mật khẩu mới">
                    <div class="form-text text-warning">Lưu ý: Nếu không muốn đổi mật khẩu, hãy để trống ô này.</div>
                </div>

                <button type="submit" class="btn btn-warning px-5 w-100">Cập nhật thông tin</button>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.authLayouts')

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-4">
        <h2 class="text-center mb-4">ĐĂNG NHẬP</h2>
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            @if($errors->any())
                <p class="text-danger small">{{ $errors->first() }}</p>
            @endif
            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
        </form>
    </div>
</div>
@endsection
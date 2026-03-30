<div class="container" style="max-width: 400px; margin-top: 100px;">
    <h2 class="text-center">ĐĂNG NHẬP HỆ THỐNG</h2>
    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mật khẩu</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        @if($errors->any())
            <p class="text-danger">{{ $errors->first() }}</p>
        @endif
        <button class="btn btn-primary w-100">Đăng nhập</button>
    </form>
</div>
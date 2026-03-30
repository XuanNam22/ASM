@extends('layouts.adminLayouts')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Quản lý Hướng dẫn viên</h2>
        <a href="{{ route('guides.create') }}" class="btn btn-primary">Thêm Hướng dẫn viên</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 30%;">Họ và tên</th>
                            <th style="width: 30%;">Email đăng nhập</th>
                            <th style="width: 20%;">Ngày tham gia</th>
                            <th style="width: 15%;" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($guides as $guide)
                            <tr>
                                <td>{{ $guide->id }}</td>
                                <td class="fw-bold text-primary">{{ $guide->name }}</td>
                                <td>{{ $guide->email }}</td>
                                <td>{{ $guide->created_at->format('d/m/Y') }}</td>
                                <td class="text-center text-nowrap">
                                    <a href="{{ route('guides.edit', $guide->id) }}" class="btn btn-sm btn-info">Sửa</a>

                                    <form action="{{ route('guides.destroy', $guide->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xóa Hướng dẫn viên này? (Các tour đang gán sẽ được đặt thành Chưa phân công)')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Chưa có hướng dẫn viên nào trong hệ thống.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $guides->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
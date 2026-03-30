@extends('layouts.adminLayouts')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Quản lý danh sách Tour</h2>
            <a href="{{ route('tours.create') }}" class="btn btn-primary">Thêm Tour Mới</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-4">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">STT</th>
                                <th style="width: 25%;">Tên Tour</th>
                                <th style="width: 12%;">Điểm đến</th>
                                <th style="width: 13%;">Thời gian</th>
                                <th style="width: 10%;">Giá</th>
                                <th style="width: 15%;">Hướng dẫn viên</th>
                                <th style="width: 10%;">Trạng thái</th>
                                <th style="width: 10%;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tours as $tour)
                                <tr>
                                    <td>{{ $tour->id }}</td>
                                    <td>{{ $tour->name }}</td>
                                    <td>{{ $tour->destination }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($tour->start_date)->format('d/m/Y') }} -
                                        {{ \Carbon\Carbon::parse($tour->end_date)->format('d/m/Y') }}
                                    </td>
                                    <td>{{ number_format($tour->price, 0, ',', '.') }} đ</td>

                                    <td>
                                        @if ($tour->guide)
                                            <span class="badge bg-info text-dark">{{ $tour->guide->name }}</span>
                                        @else
                                            <span class="text-muted">Chưa phân công</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($tour->status == 'open')
                                            <span class="badge bg-success">Mở bán</span>
                                        @elseif($tour->status == 'ongoing')
                                            <span class="badge bg-warning">Đang diễn ra</span>
                                        @else
                                            <span class="badge bg-secondary">Đã kết thúc</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('tours.edit', $tour->id) }}" class="btn btn-sm btn-info">Sửa</a>

                                        <form action="{{ route('tours.destroy', $tour->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bạn có chắc muốn xóa tour này?')">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $tours->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.adminLayouts')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Quản lý Danh sách Đặt chỗ</h2>
        <a href="{{ route('bookings.create') }}" class="btn btn-primary">Tạo Booking Mới</a>
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
                            <th style="width: 15%;">Khách hàng</th>
                            <th style="width: 15%;">Liên hệ</th>
                            <th style="width: 25%;">Tour đăng ký</th>
                            <th style="width: 5%;" class="text-center">Vé</th>
                            <th style="width: 10%;" class="text-end">Tổng tiền</th>
                            <th style="width: 10%;" class="text-center">Thanh toán</th>
                            <th style="width: 10%;" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td class="fw-bold">{{ $booking->customer_name }}</td>
                                <td>
                                    <div>{{ $booking->customer_phone }}</div>
                                    <small class="text-muted">{{ $booking->customer_email }}</small>
                                </td>
                                <td>
                                    @if($booking->tour)
                                        <a href="{{ route('tours.edit', $booking->tour_id) }}" class="text-primary text-decoration-none fw-semibold">
                                            {{ $booking->tour->name }}
                                        </a>
                                    @else
                                        <span class="text-danger">Tour đã bị xóa</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $booking->quantity }}</td>
                                <td class="text-end fw-bold text-danger">{{ number_format($booking->total_price, 0, ',', '.') }} đ</td>
                                <td class="text-center">
                                    @if ($booking->payment_status == 'unpaid')
                                        <span class="badge bg-secondary">Chưa thanh toán</span>
                                    @elseif ($booking->payment_status == 'deposit')
                                        <span class="badge bg-warning text-dark">Đã cọc</span>
                                    @elseif ($booking->payment_status == 'completed')
                                        <span class="badge bg-success">Hoàn thành</span>
                                    @else
                                        <span class="badge bg-danger">Đã hủy</span>
                                    @endif
                                </td>
                                <td class="text-center text-nowrap">
                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa đơn đặt chỗ này?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Chưa có đơn đặt chỗ nào!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $bookings->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
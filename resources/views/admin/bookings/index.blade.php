@extends('layouts.adminLayouts')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Quản lý Danh sách Đặt chỗ & Công nợ</h2>
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
                                <th style="width: 15%;">Người đại diện</th>
                                <th style="width: 20%;">Tour đăng ký</th>
                                <th style="width: 5%;" class="text-center">Số vé</th>
                                <th style="width: 10%;" class="text-end">Tổng tiền</th>
                                <th style="width: 10%;" class="text-end text-success">Đã thu</th>
                                <th style="width: 10%;" class="text-end text-danger">Còn nợ</th>
                                <th style="width: 10%;" class="text-center">Trạng thái</th>
                                <th style="width: 10%;" class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $booking->customer_name }}</div>
                                        <small class="text-muted">{{ $booking->customer_phone }}</small>
                                    </td>
                                    <td>
                                        @if ($booking->tour)
                                            <a href="{{ route('tours.edit', $booking->tour_id) }}"
                                                class="text-primary text-decoration-none fw-semibold">
                                                {{ $booking->tour->name }}
                                            </a>
                                        @else
                                            <span class="text-danger">Tour đã bị xóa</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $booking->quantity }}</td>
                                    <td class="text-end fw-bold">{{ number_format($booking->total_price, 0, ',', '.') }} đ
                                    </td>

                                    <td class="text-end text-success fw-bold">
                                        {{ number_format($booking->paid_amount, 0, ',', '.') }} đ</td>
                                    <td class="text-end text-danger fw-bold">
                                        {{ number_format($booking->remainingBalance(), 0, ',', '.') }} đ</td>

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
                                        <a href="{{ route('bookings.edit', $booking->id) }}"
                                            class="btn btn-sm btn-info">Sửa</a>
                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bạn có chắc muốn xóa đơn đặt chỗ này? Toàn bộ danh sách hành khách cũng sẽ bị xóa.')">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4">Chưa có đơn đặt chỗ nào!</td>
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

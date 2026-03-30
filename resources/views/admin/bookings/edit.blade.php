@extends('layouts.adminLayouts')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Sửa Đặt chỗ: <span class="text-primary">#{{ $booking->id }}</span></h2>
        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
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

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <h5 class="mb-3 border-bottom pb-2">Thông tin khách hàng</h5>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label text-dark fw-bold">Tên khách hàng</label>
                        <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name', $booking->customer_name) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-dark fw-bold">Số điện thoại</label>
                        <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone', $booking->customer_phone) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-dark fw-bold">Email</label>
                        <input type="email" name="customer_email" class="form-control" value="{{ old('customer_email', $booking->customer_email) }}">
                    </div>
                </div>

                <h5 class="mb-3 border-bottom pb-2">Thông tin Tour</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-dark fw-bold">Chọn Tour</label>
                        <select name="tour_id" id="tourSelect" class="form-select" required>
                            @foreach($tours as $tour)
                                <option value="{{ $tour->id }}" data-price="{{ $tour->price }}" {{ old('tour_id', $booking->tour_id) == $tour->id ? 'selected' : '' }}>
                                    {{ $tour->name }} (Giá: {{ number_format($tour->price, 0, ',', '.') }}đ)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-dark fw-bold">Số lượng vé</label>
                        <input type="number" name="quantity" id="ticketQuantity" class="form-control" value="{{ old('quantity', $booking->quantity) }}" required min="1">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-dark fw-bold">Trạng thái thanh toán</label>
                        <select name="payment_status" class="form-select" required>
                            <option value="unpaid" {{ old('payment_status', $booking->payment_status) == 'unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                            <option value="deposit" {{ old('payment_status', $booking->payment_status) == 'deposit' ? 'selected' : '' }}>Đã đặt cọc</option>
                            <option value="completed" {{ old('payment_status', $booking->payment_status) == 'completed' ? 'selected' : '' }}>Đã hoàn thành</option>
                            <option value="cancelled" {{ old('payment_status', $booking->payment_status) == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                </div>

                <div class="alert alert-info d-flex align-items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    <span class="fs-6">Tổng tiền tạm tính: <strong id="totalPricePreview" class="text-danger fs-5">{{ number_format($booking->total_price, 0, ',', '.') }} đ</strong></span>
                </div>

                <button type="submit" class="btn btn-warning px-5">Cập nhật Đặt chỗ</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tourSelect = document.getElementById('tourSelect');
        const quantityInput = document.getElementById('ticketQuantity');
        const pricePreview = document.getElementById('totalPricePreview');

        function calculateTotal() {
            const selectedOption = tourSelect.options[tourSelect.selectedIndex];
            const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
            const quantity = parseInt(quantityInput.value) || 0;
            const total = price * quantity;
            pricePreview.innerText = new Intl.NumberFormat('vi-VN').format(total) + ' đ';
        }

        tourSelect.addEventListener('change', calculateTotal);
        quantityInput.addEventListener('input', calculateTotal);
    });
</script>
@endsection
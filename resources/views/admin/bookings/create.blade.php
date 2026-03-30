@extends('layouts.adminLayouts')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Tạo Đặt chỗ (Booking) mới</h2>
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
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                
                <h5 class="mb-3 border-bottom pb-2">Thông tin khách hàng</h5>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label text-dark fw-bold">Tên khách hàng <span class="text-danger">*</span></label>
                        <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required placeholder="VD: Nguyễn Văn A">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-dark fw-bold">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}" required placeholder="VD: 0987654321">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-dark fw-bold">Email</label>
                        <input type="email" name="customer_email" class="form-control" value="{{ old('customer_email') }}" placeholder="VD: email@example.com">
                    </div>
                </div>

                <h5 class="mb-3 border-bottom pb-2">Thông tin Tour</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-dark fw-bold">Chọn Tour <span class="text-danger">*</span></label>
                        <select name="tour_id" id="tourSelect" class="form-select" required>
                            <option value="" data-price="0">-- Vui lòng chọn Tour --</option>
                            @foreach($tours as $tour)
                                <option value="{{ $tour->id }}" data-price="{{ $tour->price }}" {{ old('tour_id') == $tour->id ? 'selected' : '' }}>
                                    {{ $tour->name }} (Giá: {{ number_format($tour->price, 0, ',', '.') }}đ)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-dark fw-bold">Số lượng vé <span class="text-danger">*</span></label>
                        <input type="number" name="quantity" id="ticketQuantity" class="form-control" value="{{ old('quantity', 1) }}" required min="1">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-dark fw-bold">Trạng thái thanh toán <span class="text-danger">*</span></label>
                        <select name="payment_status" class="form-select" required>
                            <option value="unpaid" {{ old('payment_status') == 'unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                            <option value="deposit" {{ old('payment_status') == 'deposit' ? 'selected' : '' }}>Đã đặt cọc</option>
                            <option value="completed" {{ old('payment_status') == 'completed' ? 'selected' : '' }}>Đã hoàn thành</option>
                        </select>
                    </div>
                </div>

                <div class="alert alert-info d-flex align-items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info me-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    <span class="fs-6">Tổng tiền tạm tính: <strong id="totalPricePreview" class="text-danger fs-5">0 đ</strong> <small>(Hệ thống sẽ tự động lưu)</small></span>
                </div>

                <button type="submit" class="btn btn-success px-5">Tạo Đặt chỗ</button>
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
            // Lấy giá từ data-price của option đang chọn
            const selectedOption = tourSelect.options[tourSelect.selectedIndex];
            const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
            const quantity = parseInt(quantityInput.value) || 0;
            
            const total = price * quantity;
            // Format sang tiền Việt Nam
            pricePreview.innerText = new Intl.NumberFormat('vi-VN').format(total) + ' đ';
        }

        tourSelect.addEventListener('change', calculateTotal);
        quantityInput.addEventListener('input', calculateTotal);
    });
</script>
@endsection
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

                    <h5 class="mb-3 border-bottom pb-2 text-primary">1. Thông tin người đặt (Đại diện)</h5>
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label text-dark fw-bold">Tên người đại diện <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="customer_name" class="form-control"
                                value="{{ old('customer_name') }}" required placeholder="VD: Nguyễn Văn A">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-dark fw-bold">Số điện thoại <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="customer_phone" class="form-control"
                                value="{{ old('customer_phone') }}" required placeholder="VD: 0987654321">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-dark fw-bold">Email</label>
                            <input type="email" name="customer_email" class="form-control"
                                value="{{ old('customer_email') }}" placeholder="VD: email@example.com">
                        </div>
                    </div>

                    <h5 class="mb-3 border-bottom pb-2 text-primary">2. Thông tin Dịch vụ & Thanh toán</h5>
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label class="form-label text-dark fw-bold">Chọn Tour <span class="text-danger">*</span></label>
                            <select name="tour_id" id="tourSelect" class="form-select" required>
                                <option value="" data-price="0">-- Vui lòng chọn --</option>
                                @foreach ($tours as $tour)
                                    <option value="{{ $tour->id }}" data-price="{{ $tour->price }}"
                                        {{ old('tour_id') == $tour->id ? 'selected' : '' }}>
                                        {{ $tour->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-dark fw-bold">Số lượng vé <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="quantity" id="ticketQuantity" class="form-control"
                                value="{{ old('quantity', 1) }}" required min="1">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-dark fw-bold">Trạng thái thanh toán</label>
                            <select name="payment_status" class="form-select" required>
                                <option value="unpaid" {{ old('payment_status') == 'unpaid' ? 'selected' : '' }}>Chưa thanh
                                    toán</option>
                                <option value="deposit" {{ old('payment_status') == 'deposit' ? 'selected' : '' }}>Đã đặt
                                    cọc</option>
                                <option value="completed" {{ old('payment_status') == 'completed' ? 'selected' : '' }}>Đã
                                    hoàn thành</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-dark fw-bold">Số tiền đã thu / Đã cọc (VNĐ)</label>
                            <input type="number" name="paid_amount" class="form-control"
                                value="{{ old('paid_amount', 0) }}" min="0" placeholder="0">
                        </div>
                    </div>

                    <div class="alert alert-info d-flex align-items-center mb-4">
                        <span class="fs-6">Tổng tiền tạm tính: <strong id="totalPricePreview" class="text-danger fs-5">0
                                đ</strong></span>
                    </div>

                    <h5 class="mb-3 border-bottom pb-2 text-primary">3. Danh sách hành khách chi tiết</h5>
                    <div id="passengersContainer" class="mb-4">
                    </div>

                    <button type="submit" class="btn btn-success px-5 py-2 fw-bold">Tạo Đặt chỗ & Lưu danh sách</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tourSelect = document.getElementById('tourSelect');
            const quantityInput = document.getElementById('ticketQuantity');
            const pricePreview = document.getElementById('totalPricePreview');
            const passengersContainer = document.getElementById('passengersContainer');

            // Hàm tính tiền
            function calculateTotal() {
                const selectedOption = tourSelect.options[tourSelect.selectedIndex];
                const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                const quantity = parseInt(quantityInput.value) || 0;

                const total = price * quantity;
                pricePreview.innerText = new Intl.NumberFormat('vi-VN').format(total) + ' đ';
            }

            // Hàm tạo form hành khách tương ứng với số lượng vé
            function generatePassengerForms() {
                const quantity = parseInt(quantityInput.value) || 0;
                passengersContainer.innerHTML = ''; // Xóa form cũ

                for (let i = 0; i < quantity; i++) {
                    passengersContainer.innerHTML += `
                    <div class="card mb-3 border-info">
                        <div class="card-header bg-info text-white fw-bold py-2">
                            Hành khách ${i + 1}
                        </div>
                        <div class="card-body row pb-2">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" name="passengers[${i}][name]" class="form-control" required placeholder="Nhập họ tên...">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Ngày sinh</label>
                                <input type="date" name="passengers[${i}][dob]" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">CCCD/Passport</label>
                                <input type="text" name="passengers[${i}][id_card]" class="form-control" placeholder="Số giấy tờ...">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Ghi chú (Dị ứng, ăn chay...)</label>
                                <input type="text" name="passengers[${i}][note]" class="form-control" placeholder="Ghi chú thêm...">
                            </div>
                        </div>
                    </div>
                `;
                }
            }

            // Bắt sự kiện
            tourSelect.addEventListener('change', calculateTotal);
            quantityInput.addEventListener('input', () => {
                calculateTotal();
                generatePassengerForms();
            });

            // Chạy lần đầu tiên khi load trang
            calculateTotal();
            generatePassengerForms();
        });
    </script>
@endsection

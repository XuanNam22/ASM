@extends('layouts.adminLayouts')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Quản lý đoàn: <span class="text-primary">{{ $tour->name }}</span></h2>
                <p class="text-muted mb-0">Thời gian: {{ \Carbon\Carbon::parse($tour->start_date)->format('d/m/Y') }} -
                    {{ \Carbon\Carbon::parse($tour->end_date)->format('d/m/Y') }}</p>
            </div>
            <a href="{{ route('guide.dashboard') }}" class="btn btn-secondary">Quay lại Tổng quan</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" class="feather feather-check-circle me-2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-bold">Điểm danh ngày: <span
                        class="text-danger">{{ \Carbon\Carbon::parse($today)->format('d/m/Y') }}</span></h5>
                <span class="badge bg-primary fs-6">Sĩ số: {{ $tour->bookings->sum('quantity') }} khách</span>
            </div>

            <div class="card-body p-0">
                <form action="{{ route('guide.tours.attendance.save', $tour->id) }}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 5%;" class="text-center">STT</th>
                                    <th style="width: 20%;">Đại diện nhóm</th>
                                    <th style="width: 15%;">Liên hệ</th>
                                    <th style="width: 10%;" class="text-center">Số vé</th>
                                    <th style="width: 15%;" class="text-center">Có mặt hôm nay?</th>
                                    <th style="width: 35%;">Ghi chú của HDV</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tour->bookings as $index => $booking)
                                    @php
                                        // Kiểm tra xem khách này đã được điểm danh hôm nay chưa
                                        $att = $attendances->get($booking->id);
                                        $isPresent = $att ? $att->is_present : false;
                                        $note = $att ? $att->guide_note : '';
                                    @endphp
                                    <tr>
                                        <td class="text-center align-middle">{{ $index + 1 }}</td>
                                        <td class="fw-bold align-middle">{{ $booking->customer_name }}</td>
                                        <td class="align-middle">{{ $booking->customer_phone }}</td>
                                        <td class="text-center align-middle fw-bold fs-5 text-info">
                                            {{ $booking->quantity }}</td>

                                        <td class="text-center align-middle bg-light">
                                            <div class="form-check form-switch d-flex justify-content-center">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    style="width: 40px; height: 20px;"
                                                    name="is_present[{{ $booking->id }}]" value="1"
                                                    {{ $isPresent ? 'checked' : '' }}>
                                            </div>
                                        </td>

                                        <td class="align-middle bg-light">
                                            <input type="text" class="form-control"
                                                name="guide_note[{{ $booking->id }}]" value="{{ $note }}"
                                                placeholder="VD: Đón trễ, say xe, ăn chay...">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            Tour này hiện chưa có khách hàng nào đặt chỗ.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($tour->bookings->count() > 0)
                        <div class="p-4 bg-white border-top text-end">
                            <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" class="feather feather-save me-1">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                    <polyline points="7 3 7 8 15 8"></polyline>
                                </svg>
                                LƯU ĐIỂM DANH HÔM NAY
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection

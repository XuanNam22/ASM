@extends('layouts.adminLayouts')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Điểm danh: <span class="text-primary">{{ $tour->name }}</span></h2>
        <a href="{{ route('tours.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Danh sách khách hàng - Ngày: {{ \Carbon\Carbon::parse($today)->format('d/m/Y') }}</h5>
        </div>
        <div class="card-body p-0">
            <form action="{{ route('attendances.store', $tour->id) }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;" class="text-center">STT</th>
                                <th style="width: 25%;">Họ và Tên</th>
                                <th style="width: 15%;">Thông tin</th>
                                <th style="width: 15%;" class="text-center">Có mặt?</th>
                                <th style="width: 40%;">Ghi chú của HDV</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($passengers as $index => $passenger)
                                @php
                                    // Kiểm tra xem khách này hôm nay đã được điểm danh có mặt chưa
                                    $isPresent = isset($attendancesToday[$passenger->id]) && $attendancesToday[$passenger->id]->is_present;
                                    $note = isset($attendancesToday[$passenger->id]) ? $attendancesToday[$passenger->id]->guide_note : '';
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="fw-bold">{{ $passenger->name }}</td>
                                    <td>
                                        <small class="d-block text-muted">NS: {{ $passenger->dob ? \Carbon\Carbon::parse($passenger->dob)->format('d/m/Y') : 'N/A' }}</small>
                                        <small class="d-block text-muted">Giấy tờ: {{ $passenger->id_card ?? 'N/A' }}</small>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="present_passengers[]" value="{{ $passenger->id }}" 
                                            class="form-check-input" style="transform: scale(1.5);" 
                                            {{ $isPresent ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <input type="text" name="notes[{{ $passenger->id }}]" class="form-control" 
                                            placeholder="VD: Đến trễ 15p, ốm ở lại k/s..." value="{{ $note }}">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Tour này hiện chưa có hành khách nào đặt chỗ.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($passengers->count() > 0)
                <div class="p-3 bg-light border-top d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-5 fw-bold">Lưu Điểm Danh</button>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.adminLayouts')

@section('content')
    <div class="row layout-top-spacing">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card bg-primary h-100 shadow-sm">
                <div class="card-body pt-4">
                    <h6 class="card-title mb-2 text-white">TỔNG SỐ TOUR</h6>
                    <h2 class="text-white font-weight-bold">{{ $totalTours ?? 0 }}</h2>
                    <p class="card-text text-white-50">Đang lưu trữ trên hệ thống</p>
                </div>
                <div class="card-footer px-4 pt-0 border-0 bg-transparent">
                    <a href="{{ route('tours.index') }}" class="text-white font-weight-bold">Xem chi tiết &rarr;</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card bg-secondary h-100 shadow-sm">
                <div class="card-body pt-4">
                    <h6 class="card-title mb-2 text-white">HƯỚNG DẪN VIÊN</h6>
                    <h2 class="text-white font-weight-bold">{{ $totalGuides ?? 0 }}</h2>
                    <p class="card-text text-white-50">Nhân sự sẵn sàng dẫn đoàn</p>
                </div>
                <div class="card-footer px-4 pt-0 border-0 bg-transparent">
                    <a href="#" class="text-white font-weight-bold">Xem danh sách &rarr;</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card bg-dark h-100 shadow-sm">
                <div class="card-body pt-4">
                    <h6 class="card-title mb-2 text-white">LƯỢT ĐẶT CHỖ (BOOKING)</h6>
                    <h2 class="text-white font-weight-bold">{{ $totalBookings ?? 0 }}</h2>
                    <p class="card-text text-white-50">Tổng số đơn khách đặt tour</p>
                </div>
                <div class="card-footer px-4 pt-0 border-0 bg-transparent">
                    <a href="#" class="text-white font-weight-bold">Quản lý Booking &rarr;</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card bg-danger h-100 shadow-sm">
                <div class="card-body pt-4">
                    <h6 class="card-title mb-2 text-white">DOANH THU ĐÃ THU</h6>
                    <h2 class="text-white font-weight-bold">{{ number_format($revenue ?? 0, 0, ',', '.') }}đ</h2>
                    <p class="card-text text-white-50">Từ các đơn đã thanh toán</p>
                </div>
                <div class="card-footer px-4 pt-0 border-0 bg-transparent">
                    <a href="#" class="text-white font-weight-bold">Xem báo cáo &rarr;</a>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 pt-3 pb-2 px-4">
                            <h4>Tour Vừa Cập Nhật</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-4">
                            <thead class="table-light">
                                <tr>
                                    <th>Tên Tour</th>
                                    <th>Điểm đến</th>
                                    <th>Ngày khởi hành</th>
                                    <th>Mức giá</th>
                                    <th class="text-center">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTours ?? [] as $tour)
                                <tr>
                                    <td class="font-weight-bold text-primary">{{ $tour->name }}</td>
                                    <td>{{ $tour->destination }}</td>
                                    <td>{{ \Carbon\Carbon::parse($tour->start_date)->format('d/m/Y') }}</td>
                                    <td>{{ number_format($tour->price, 0, ',', '.') }} VNĐ</td>
                                    <td class="text-center">
                                        @if($tour->status == 'open') <span class="badge bg-success">Mở bán</span>
                                        @elseif($tour->status == 'ongoing') <span class="badge bg-warning">Đang diễn ra</span>
                                        @else <span class="badge bg-secondary">Đã kết thúc</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Chưa có dữ liệu Tour nào trong hệ thống.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
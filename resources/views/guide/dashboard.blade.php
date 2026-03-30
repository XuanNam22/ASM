@extends('layouts.adminLayouts')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Xin chào, <span class="text-primary">{{ Auth::user()->name }}</span>! 👋</h2>
            <span class="badge bg-info text-dark fs-6">Hướng dẫn viên</span>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 border-start border-primary border-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-map text-primary">
                                <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
                                <line x1="8" y1="2" x2="8" y2="18"></line>
                                <line x1="16" y1="6" x2="16" y2="22"></line>
                            </svg>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Tổng số Tour phụ trách</h6>
                            <h3 class="mb-0 fw-bold">{{ $totalTours }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 border-start border-warning border-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-3 rounded me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-activity text-warning">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Tour đang dẫn (Ongoing)</h6>
                            <h3 class="mb-0 fw-bold">{{ $ongoingTours }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 border-start border-success border-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-calendar text-success">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Tour sắp khởi hành</h6>
                            <h3 class="mb-0 fw-bold">{{ $upcomingTours }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Lịch trình của tôi</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 30%;">Tên Tour</th>
                                <th style="width: 15%;">Điểm đến</th>
                                <th style="width: 20%;">Thời gian</th>
                                <th style="width: 15%;" class="text-center">Trạng thái</th>
                                <th style="width: 15%;" class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($myTours as $tour)
                                <tr>
                                    <td>{{ $tour->id }}</td>
                                    <td class="fw-bold">{{ $tour->name }}</td>
                                    <td>{{ $tour->destination }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($tour->start_date)->format('d/m/Y') }} -
                                        {{ \Carbon\Carbon::parse($tour->end_date)->format('d/m/Y') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($tour->status == 'open')
                                            <span class="badge bg-success">Sắp khởi hành</span>
                                        @elseif($tour->status == 'ongoing')
                                            <span class="badge bg-warning text-dark">Đang diễn ra</span>
                                        @else
                                            <span class="badge bg-secondary">Đã kết thúc</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('guide.tours.show', $tour->id) }}"
                                            class="btn btn-sm btn-primary">Xem đoàn & Điểm danh</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        Bạn chưa được phân công dẫn Tour nào.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $myTours->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

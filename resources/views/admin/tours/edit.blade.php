@extends('layouts.adminLayouts')

@section('content')
    <div class="container-fluid mt-4">
        <h2>Sửa thông tin Tour: <span class="text-primary">{{ $tour->name }}</span></h2>
        <a href="{{ route('tours.index') }}" class="btn btn-secondary mb-3">Quay lại danh sách</a>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('tours.update', $tour->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tên Tour</label>
                            <input type="text" name="name" class="form-control" value="{{ $tour->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Điểm đến</label>
                            <input type="text" name="destination" class="form-control" value="{{ $tour->destination }}"
                                required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Ngày khởi hành</label>
                            <input type="date" name="start_date" class="form-control" value="{{ $tour->start_date }}"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ngày kết thúc</label>
                            <input type="date" name="end_date" class="form-control" value="{{ $tour->end_date }}"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Giá Tour (VNĐ)</label>
                            <input type="number" name="price" class="form-control" value="{{ round($tour->price) }}"
                                required min="0">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Số chỗ tối đa</label>
                            <input type="number" name="max_passengers" class="form-control"
                                value="{{ $tour->max_passengers }}" required min="1">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Số khách tối thiểu để khởi hành</label>
                            <input type="number" name="min_passengers" class="form-control"
                                value="{{ $tour->min_passengers }}" required min="1">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Phân công Hướng dẫn viên</label>
                            <select name="guide_id" class="form-select">
                                <option value="">-- Chưa phân công --</option>
                                @foreach ($guides as $guide)
                                    <option value="{{ $guide->id }}"
                                        {{ $tour->guide_id == $guide->id ? 'selected' : '' }}>
                                        {{ $guide->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Trạng thái</label>
                            <select name="status" class="form-select">
                                <option value="open" {{ $tour->status == 'open' ? 'selected' : '' }}>Mở bán</option>
                                <option value="ongoing" {{ $tour->status == 'ongoing' ? 'selected' : '' }}>Đang diễn ra
                                </option>
                                <option value="closed" {{ $tour->status == 'closed' ? 'selected' : '' }}>Đã đóng</option>
                                <option value="cancelled" {{ $tour->status == 'cancelled' ? 'selected' : '' }}>Đã hủy
                                </option>
                                <option value="completed" {{ $tour->status == 'completed' ? 'selected' : '' }}>Đã hoàn
                                    thành</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning px-5">Cập nhật Tour</button>
                </form>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

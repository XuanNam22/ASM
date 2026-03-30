@extends('layouts.adminLayouts')

@section('content')
    <div class="container-fluid mt-4">
        <h2>Thêm Tour Mới</h2>
        <a href="{{ route('tours.index') }}" class="btn btn-secondary mb-3">Quay lại danh sách</a>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('tours.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tên Tour</label>
                            <input type="text" name="name" class="form-control" required
                                placeholder="VD: Tour Sapa 3N2Đ...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Điểm đến</label>
                            <input type="text" name="destination" class="form-control" required
                                placeholder="VD: Sapa, Đà Lạt...">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Ngày khởi hành</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ngày kết thúc</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Giá Tour (VNĐ)</label>
                            <input type="number" name="price" class="form-control" required min="0">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Phân công Hướng dẫn viên</label>
                            <select name="guide_id" class="form-select">
                                <option value="">-- Chưa phân công (Để trống) --</option>
                                @foreach ($guides as $guide)
                                    <option value="{{ $guide->id }}">{{ $guide->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Trạng thái</label>
                            <select name="status" class="form-select">
                                <option value="open">Mở bán</option>
                                <option value="ongoing">Đang diễn ra</option>
                                <option value="closed">Đã kết thúc</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success px-5">Lưu Tour Mới</button>
                </form>
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
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

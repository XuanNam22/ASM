@extends('layouts.adminLayouts')

@section('content')
    <div class="row layout-top-spacing">

        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card bg-primary">
                <div class="card-body pt-3">
                    <h5 class="card-title mb-3">Tổng nhân viên</h5>
                    <p class="card-text">{{ $danhSachNV->total() }} nhân viên.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Danh sách nhân viên</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th style="width: 5%">STT</th>
                                    <th style="width: 20%">Họ tên</th>
                                    <th style="width: 25%">Email</th>
                                    <th style="width: 12%">Ngày sinh</th>
                                    <th style="width: 10%">Giới tính</th>
                                    <th style="width: 13%">Lương</th>
                                    <th style="width: 15%">Phòng ban</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($danhSachNV as $nv)
                                    <tr>
                                        <td>{{ $nv->id }}</td>
                                        <td>{{ $nv->ho_ten }}</td>
                                        <td>{{ $nv->email }}</td>
                                        <td>{{ $nv->ngay_sinh }}</td>
                                        <td>{{ $nv->gioi_tinh ? 'Nam' : 'Nữ' }}</td>
                                        <td>{{ $nv->luong }}</td>
                                        <td>{{ $nv->phong_ban }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $danhSachNV->links('') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

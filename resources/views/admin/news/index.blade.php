@extends('layouts.adminLayouts')

@section('content')
    <div class="row layout-top-spacing">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="card bg-primary">
                <div class="card-body pt-3">
                    <h5 class="card-title mb-3">Tổng tin tức</h5>
                    <p class="card-text">{{ $danhSachTinTuc->total() }} bài viết được hiển thị</p>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Danh sách tin tức</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-4 custom-table">
                            <thead>
                                <tr>
                                    <th style="width: 5%">STT</th>
                                    <th style="width: 25%">Tiêu đề</th>
                                    <th style="width: 15%">Tác giả</th>
                                    <th style="width: 15%">Ngày đăng</th>
                                    <th style="width: 40%">Nội dung</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($danhSachTinTuc as $tin)
                                    <tr>
                                        <td>{{ $tin->id }}</td>
                                        <td>{{ $tin->tieu_de }}</td>
                                        <td>{{ $tin->tac_gia }}</td>
                                        <td>{{ $tin->ngay_dang }}</td>
                                        <td>
                                            <div class="truncate-text">
                                                {{ $tin->noi_dung }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $danhSachTinTuc->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

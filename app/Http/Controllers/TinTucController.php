<?php

namespace App\Http\Controllers;

use App\Models\TinTuc;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTinTucRequest;
use App\Http\Requests\UpdateTinTucRequest;
use Illuminate\Support\Facades\DB;

class TinTucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy tin tức có hien_thi = true (hoặc 1), sắp xếp ngày đăng mới nhất lên đầu, phân trang 10 bài
        $danhSachTinTuc = DB::table('tin_tucs')
            ->where('hien_thi', '=', true)
            ->orderBy('ngay_dang', 'desc')
            ->paginate(10);

        // Trả về view theo cấu trúc chuyên nghiệp
        return view('admin.news.index', compact('danhSachTinTuc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTinTucRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TinTuc $tinTuc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TinTuc $tinTuc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTinTucRequest $request, TinTuc $tinTuc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TinTuc $tinTuc)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNhanVienRequest;
use App\Http\Requests\UpdateNhanVienRequest;
use Illuminate\Support\Facades\DB;

class NhanVienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   // orderBy('cột cần sắp xếp', 'cách sắp xếp') 
        // asc tăng dần, desc giảm dần
        $danhSachNV = DB::table('nhan_viens')->orderBy('id', 'asc') -> paginate(10);
        // trả về view với giá trị compact('danhSachNV')
        return view('admin.users.index', compact('danhSachNV'));
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
    public function store(StoreNhanVienRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NhanVien $nhanVien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NhanVien $nhanVien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNhanVienRequest $request, NhanVien $nhanVien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NhanVien $nhanVien)
    {
        //
    }
}

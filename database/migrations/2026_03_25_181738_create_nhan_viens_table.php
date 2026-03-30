<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nhan_viens', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten');
            $table->string('email')->unique(); // không trùng (unique)
            $table->date('ngay_sinh');
            $table->boolean('gioi_tinh'); 

            // Tổng số chữ số tối đa có thể lưu trữ là 10 số
            // Trong 10 số đó, dành ra 2 số nằm sau dấu phẩy
            $table->decimal('luong', 10, 2);
            
            $table->string('phong_ban');

            // Tự động sinh ra 2 cột: 'created_at' (Ngày giờ tạo bản ghi) và 'updated_at' (Ngày giờ chỉnh sửa cuối cùng).
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhan_viens');
    }
};

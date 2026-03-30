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
        Schema::create('booking_passengers', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại liên kết với bảng bookings (Xóa booking thì xóa luôn danh sách khách)
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();
            
            $table->string('name'); // Họ và tên hành khách
            $table->date('dob')->nullable(); // Ngày tháng năm sinh (Cần để mua bảo hiểm)
            $table->string('id_card')->nullable(); // Số CCCD / Passport (Cần để nhận phòng khách sạn/bay)
            $table->text('note')->nullable(); // Ghi chú (VD: Ăn chay, dị ứng hải sản...)
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_passengers');
    }
};

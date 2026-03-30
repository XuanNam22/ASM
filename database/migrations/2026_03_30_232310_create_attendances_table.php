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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained('tours')->cascadeOnDelete(); // Thuộc tour nào
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete(); // Của nhóm khách nào
            $table->boolean('is_present')->default(false); // Có mặt không? (Mặc định: Vắng)
            $table->text('guide_note')->nullable(); // Ghi chú của HDV
            $table->date('report_date'); // Ngày báo cáo điểm danh
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};

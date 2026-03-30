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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên tour
            $table->string('image')->nullable(); // Ảnh (cho phép rỗng)
            $table->string('destination'); // Điểm đến
            $table->date('start_date'); // Ngày đi
            $table->date('end_date'); // Ngày về
            $table->decimal('price', 10, 2); // Giá tour

            // Khóa ngoại liên kết tới bảng users (chỉ những user có role='guide' mới được gán)
            $table->foreignId('guide_id')->nullable()->constrained('users')->nullOnDelete();

            $table->enum('status', ['open', 'ongoing', 'closed'])->default('open'); // Trạng thái
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};

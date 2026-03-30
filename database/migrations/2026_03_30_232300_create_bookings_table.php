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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained('tours')->cascadeOnDelete(); // Đặt tour nào
            $table->string('customer_name'); // Tên khách
            $table->string('customer_phone'); // Số điện thoại
            $table->string('customer_email')->nullable(); // Email
            $table->integer('quantity'); // Số lượng vé
            $table->decimal('total_price', 12, 2); // Tổng tiền
            $table->enum('payment_status', ['unpaid', 'deposit', 'completed', 'cancelled'])->default('unpaid'); // Trạng thái thanh toán
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

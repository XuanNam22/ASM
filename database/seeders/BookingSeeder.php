<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Tour;
use Faker\Factory as Faker;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        // Lấy danh sách tất cả các Tour hiện có trong database
        $tours = Tour::all();

        // Nếu chưa có Tour nào thì không thể tạo Booking, thoát luôn
        if ($tours->isEmpty()) {
            return;
        }

        $statuses = ['unpaid', 'deposit', 'completed', 'cancelled'];

        // Vòng lặp tạo 30 Booking ảo
        for ($i = 1; $i <= 30; $i++) {
            // Lấy ngẫu nhiên 1 Tour trong danh sách
            $tour = $tours->random();
            
            // Random số lượng vé khách đặt (từ 1 đến 5 người)
            $quantity = $faker->numberBetween(1, 5);

            Booking::create([
                'tour_id' => $tour->id,
                'customer_name' => $faker->name,
                'customer_phone' => $faker->phoneNumber,
                'customer_email' => $faker->unique()->safeEmail,
                'quantity' => $quantity,
                'paid_amount' => 0,
                'total_price' => $tour->price * $quantity,
                'payment_status' => $faker->randomElement($statuses),
            ]);
        }
    }
}
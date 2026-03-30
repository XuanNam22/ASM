<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;
use App\Models\User;
use Faker\Factory as Faker;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        // Khởi tạo Faker với ngôn ngữ tiếng Việt
        $faker = Faker::create('vi_VN');
        
        // Lấy danh sách ID của tất cả hướng dẫn viên
        $guideIds = User::where('role', 'guide')->pluck('id')->toArray();
        $statuses = ['open', 'ongoing', 'closed'];

        // Vòng lặp tạo 25 Tours
        for ($i = 1; $i <= 25; $i++) {
            // Ngày đi: Random từ hôm nay đến 3 tháng sau
            $startDate = $faker->dateTimeBetween('now', '+3 months');
            
            // Random số ngày đi tour (từ 2 đến 5 ngày)
            $days = $faker->numberBetween(2, 5); 
            
            // Ngày về = Ngày đi + Số ngày
            $endDate = (clone $startDate)->modify("+$days days");

            // Chọn ngẫu nhiên 1 điểm đến (thành phố)
            $destination = $faker->city; 

            Tour::create([
                'name' => 'Tour khám phá ' . $destination . ' ' . $days . 'N' . ($days - 1) . 'Đ',
                // Tạo link ảnh ngẫu nhiên (hoặc để null cũng được vì trong migration bạn set nullable)
                'image' => 'https://picsum.photos/400/300?random=' . $i, 
                'destination' => $destination,
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
                // Giá tour: Random từ 1.500.000 đến 10.000.000 (định dạng decimal)
                'price' => $faker->randomFloat(2, 1500000, 10000000), 
                // Gán ngẫu nhiên 1 Hướng dẫn viên (nếu có)
                'guide_id' => !empty($guideIds) ? $faker->randomElement($guideIds) : null,
                'status' => $faker->randomElement($statuses),
            ]);
        }
    }
}
<?php

namespace Database\Factories;

use App\Models\TinTuc;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TinTuc>
 */
class TinTucFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // fake câu văn ngắn làm tiêu đề
            'tieu_de' => fake()->sentence(),

            // fake đoạn văn bản làm nội dung bài viết
            // fake()->paragraphs(số đoạn văn, nối hay tách), (true = nối), (false = tách)
            'noi_dung' => fake()->paragraphs(3, true),

            // fake tên 
            'tac_gia' => fake()->name(),

            // fake ngày ngẫu nhiên trong khoảng 
            // fake()->dateTimeBetween(ngày 1, ngày 2),
            'ngay_dang' => fake()->dateTimeBetween('-1 year', 'now'),

            // fake true, false
            'hien_thi' => fake()->boolean(),
        ];
    }
}

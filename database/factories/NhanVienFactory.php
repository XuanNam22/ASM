<?php

namespace Database\Factories;

use App\Models\NhanVien;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<NhanVien>
 */
class NhanVienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // fake ra tên ngẫu nhiên
            'ho_ten' => fake()->name(),

            // fake ra email không trùng nhau (unique) và email an toàn (safeEmail)
            'email' => fake()->unique()->safeEmail(),

            // fake ra ngày sinh
            // fake()->date(định dạng ngày sinh, ngày sinh nhỏ tuổi nhất có thể xảy ra),
            'ngay_sinh' => fake()->date('Y-m-d', '2005-12-31'),

            // fake ra giá trị boolean ngẫu nhiên (0 hoặc 1)
            'gioi_tinh' => fake()->boolean(),

            // fake ra một số nguyên ngẫu nhiên trong khoảng giá trị
            // fake()->numberBetween(min, max)
            'luong' => fake()->numberBetween(5, 30) * 1000000,

            // fake giá trị ngẫu nhiên trong mảng 
            // fake()->randomElement([giá trị 1, giá trị 2, ...])
            'phong_ban' => fake()->randomElement(['Nhân sự', 'IT', 'Marketing', 'Kế toán', 'Kinh doanh']),
        ];
    }
}

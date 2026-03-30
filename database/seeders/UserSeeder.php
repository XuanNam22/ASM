<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tạo 2 tài khoản Admin
        User::create([
            'name' => 'Admin Chính',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Admin Phụ',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        // 2. Tạo 1 Hướng dẫn viên cố định (Dùng để test)
        User::create([
            'name' => 'HDV Trần Dương',
            'email' => 'guide@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'guide',
        ]);

        // 3. Sử dụng Faker tạo thêm 14 Hướng dẫn viên ảo (Tổng 15 HDV)
        $faker = Faker::create('vi_VN'); 
        for ($i = 2; $i <= 15; $i++) {
            User::create([
                'name' => 'HDV ' . $faker->name,
                'email' => 'guide' . $i . '@gmail.com', 
                'password' => Hash::make('123456'),
                'role' => 'guide',
            ]);
        }
    }
}
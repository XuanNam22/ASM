<?php

namespace Database\Seeders;

use App\Models\NhanVien;
use App\Models\TinTuc;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        NhanVien::factory(100)->create();
        TinTuc::factory(50)->create();
    }
}

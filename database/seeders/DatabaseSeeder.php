<?php

namespace Database\Seeders;

use App\Models\FotoCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $category = ['Alam', 'Sedih', 'Seram', 'Hewan', 'Bayi', 'Sekolah', 'Programming'];
        for ($i = 0; $i < count($category); $i++) {
            FotoCategory::create([
                'name' => $category[$i]
            ]);
        }
    }
}

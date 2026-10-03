<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Obat', 'description' => 'Obat resep dan obat bebas untuk berbagai keluhan kesehatan.'],
            ['name' => 'Vitamin & Suplemen', 'description' => 'Vitamin dan suplemen untuk menjaga daya tahan tubuh.'],
            ['name' => 'Alat Kesehatan', 'description' => 'Perlengkapan dan alat kesehatan rumah tangga.'],
            ['name' => 'Ibu & Anak', 'description' => 'Kebutuhan kesehatan ibu hamil, menyusui, dan anak-anak.'],
            ['name' => 'Personal Care', 'description' => 'Produk perawatan diri dan kebersihan tubuh.'],
            ['name' => 'P3K', 'description' => 'Perlengkapan pertolongan pertama pada kecelakaan.'],
        ];

        foreach ($categories as $index => $category) {
            Category::firstOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
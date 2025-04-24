<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Sepatu Lari',
                'slug' => Str::slug('Sepatu Lari'),
                'description' => 'Koleksi sepatu lari terbaik untuk performa maksimal'
            ],
            [
                'name' => 'Sepatu Casual',
                'slug' => Str::slug('Sepatu Casual'),
                'description' => 'Sepatu casual nyaman untuk aktivitas sehari-hari'
            ],
            [
                'name' => 'Sepatu Olahraga',
                'slug' => Str::slug('Sepatu Olahraga'),
                'description' => 'Sepatu olahraga berkualitas untuk berbagai jenis olahraga'
            ]
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }
    }
} 
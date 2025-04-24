<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Nike Air Max',
                'slug' => Str::slug('Nike Air Max'),
                'description' => 'Sepatu lari dengan teknologi Air Max untuk kenyamanan maksimal',
                'price' => 1999000,
                'stock' => 10,
                'image' => 'nike-air-max.jpg',
                'category_id' => 1,
                'is_featured' => true
            ],
            [
                'name' => 'Adidas Ultraboost',
                'slug' => Str::slug('Adidas Ultraboost'),
                'description' => 'Sepatu lari dengan teknologi Boost untuk responsivitas maksimal',
                'price' => 2499000,
                'stock' => 15,
                'image' => 'adidas-ultraboost.jpg',
                'category_id' => 1,
                'is_featured' => true
            ],
            [
                'name' => 'New Balance 574',
                'slug' => Str::slug('New Balance 574'),
                'description' => 'Sepatu casual klasik dengan kenyamanan maksimal',
                'price' => 1499000,
                'stock' => 20,
                'image' => 'new-balance-574.jpg',
                'category_id' => 2,
                'is_featured' => true
            ]
        ];

        foreach ($products as $product) {
            DB::table('products')->insert($product);
        }
    }
} 
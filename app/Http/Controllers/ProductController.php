<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{
    public function index()
    {
        // Data statis untuk produk
        $products = [
            [
                'name' => 'Sepatu Running',
                'description' => 'Sepatu olahraga yang nyaman untuk berlari',
                'price' => 999000,
                'image' => 'Asset/gambar1.png'
            ],
            [
                'name' => 'Sepatu Casual',
                'description' => 'Sepatu santai untuk sehari-hari',
                'price' => 799000,
                'image' => 'Asset/gambar2.png'
            ],
            [
                'name' => 'Sepatu Formal',
                'description' => 'Sepatu formal untuk acara resmi',
                'price' => 1299000,
                'image' => 'Asset/gambar3.png'
            ]
        ];

        // Convert array ke object untuk mempertahankan kompatibilitas dengan view
        $products = array_map(function($product) {
            return (object) $product;
        }, $products);

        return view('hello', compact('products'));
    }
} 
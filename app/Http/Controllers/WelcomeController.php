<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)->get();
        return view('welcome', compact('featuredProducts'));
    }
} 
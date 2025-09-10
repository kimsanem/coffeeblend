<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use App\Models\Product\Review;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $products = Product::select()
            ->orderBy('id', 'desc')
            ->take('4')
            ->get();
        $reviews = Review::select()->orderBy('id', 'desc')->take('4')->get();
        return view('about', compact('products', 'reviews'));
    }
}
